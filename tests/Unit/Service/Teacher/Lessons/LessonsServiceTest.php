<?php

namespace Service\Teacher\Lessons;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Teacher\Lessons\LessonsService;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;
use DateTime;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class LessonsServiceTest extends TestCase
{
    private LessonsService $service;
    private LessonRepositoryInterface $lessonRepository;
    private UserLessonRepositoryInterface $userLessonRepository;
    private EvaluationRepositoryInterface $evaluationRepository;
    private StudentEvaluationsTransformerInterface $studentEvaluationResponseModelTransformer;
    private StudentEvaluationsValidatorInterface $studentEvaluationResponseModelValidator;
    private LoggerInterface $logger;
    private TransformerToObjectInterface $evaluationRequestModelTransformer;
    private TransformerToObjectInterface $dateRequestModelTransformer;
    private TransformerInterface $lessonTransformer;
    private ValidatorInterface $lessonModelValidator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonRepository = $this->createMock(LessonRepositoryInterface::class);
        $this->userLessonRepository = $this->createMock(UserLessonRepositoryInterface::class);
        $this->evaluationRepository = $this->createMock(EvaluationRepositoryInterface::class);
        $this->studentEvaluationResponseModelTransformer =
            $this->createMock(StudentEvaluationsTransformerInterface::class);
        $this->studentEvaluationResponseModelValidator =
            $this->createMock(StudentEvaluationsValidatorInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->evaluationRequestModelTransformer = $this->createMock(TransformerInterface::class);
        $this->dateRequestModelTransformer = $this->createMock(TransformerInterface::class);
        $this->lessonTransformer = $this->createMock(TransformerInterface::class);
        $this->lessonModelValidator = $this->createMock(ValidatorInterface::class);

        $this->service = new LessonsService(
            $this->lessonRepository,
            $this->userLessonRepository,
            $this->evaluationRepository,
            $this->studentEvaluationResponseModelTransformer,
            $this->studentEvaluationResponseModelValidator,
            $this->logger
        );

        $this->service->setLessonModelValidator($this->lessonModelValidator);
        $this->service->setLessonTransformer($this->lessonTransformer);
        $this->service->setDateRequestModelTransformer($this->dateRequestModelTransformer);
        $this->service->setEvaluationRequestModelTransformer($this->evaluationRequestModelTransformer);
    }

    public function testDestroyEvaluationCallsFunction(): void
    {
        $id = '00000000-0000-0000-0000-000000000000';
        $this->evaluationRepository->expects($this->once())
            ->method('deleteElementById');

        $this->service->destroyEvaluation($id);
    }

    public function testStoreEvaluationCallsAllFunctions(): void
    {
        $value = 5;
        $userLessonId = '00000000-0000-0000-0000-000000000000';
        $date = "2022-12-20";
        $evaluationRequestModel = new EvaluationRequestModel($value, $userLessonId, $date);

        $this->evaluationRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn($evaluationRequestModel);

        $this->evaluationRepository->expects($this->once())
            ->method('save');

        $this->service->storeEvaluation([]);
    }

    public function testGetAllLessonsCallsAllFunctionsWhenCorrect(): void
    {
        $this->lessonRepository->expects($this->once())
            ->method('getAll');

        $this->lessonModelValidator->expects($this->once())
            ->method('validateMany');

        $this->lessonTransformer->expects($this->once())
            ->method('transformToCollection');

        $this->logger->expects($this->never())
            ->method('error');

        $this->service->getAllLessons();
    }

    public function testGetAllLessonsWhenExceptionThrownLoggerIsCalled(): void
    {
        $this->lessonRepository->expects($this->once())
            ->method('getAll');

        $this->lessonModelValidator->expects($this->once())
            ->method('validateMany')
            ->willThrowException(new ValidatorException());

        $this->logger->expects($this->once())
            ->method('error');

        $this->service->getAllLessons();
    }

    public function testGetUsersResponseModelCallsAllFunctionsWhenCorrect(): void
    {
        $lessonId = '00000000-0000-0000-0000-000000000000';
        $lessonName = 'Math';
        $date = ["2022-12-20"];
        $dateRequestModel = new DateRequestModel(new DateTime($date[0]));

        $this->dateRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn($dateRequestModel);

        $this->userLessonRepository->expects($this->once())
            ->method('getStudentsWithEvaluationsInConcreteLesson');

        $this->studentEvaluationResponseModelValidator->expects($this->once())
            ->method('validate');

        $this->studentEvaluationResponseModelTransformer->expects($this->once())
            ->method('transformToCollection');

        $this->lessonRepository->expects($this->once())
            ->method('getElementById');

        $this->lessonModelValidator->expects($this->once())
            ->method('validateElement');

        $this->lessonTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn(new LessonModel($lessonId, $lessonName));

        $this->logger->expects($this->never())
            ->method('error');

        $this->service->getUsersResponseModel($lessonId, $date);
    }

    public function testGetUsersResponseModelWhenExceptionThrownLoggerIsCalled(): void
    {
        $lessonId = '00000000-0000-0000-0000-000000000000';
        $lessonName = 'Math';
        $date = ["2022-12-20"];
        $dateRequestModel = new DateRequestModel(new DateTime($date[0]));

        $this->dateRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn($dateRequestModel);

        $this->userLessonRepository->expects($this->once())
            ->method('getStudentsWithEvaluationsInConcreteLesson');

        $this->studentEvaluationResponseModelValidator->expects($this->once())
            ->method('validate');

        $this->studentEvaluationResponseModelTransformer->expects($this->once())
            ->method('transformToCollection');

        $this->lessonModelValidator->expects($this->once())
            ->method('validateElement')
            ->willThrowException(new ValidatorException());

        $this->logger->expects($this->once())
            ->method('error');

        $this->lessonTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn(new LessonModel($lessonId, $lessonName));

        $this->service->getUsersResponseModel($lessonId, $date);
    }
}
