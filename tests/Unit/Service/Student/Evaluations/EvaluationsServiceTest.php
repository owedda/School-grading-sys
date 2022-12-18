<?php

namespace Service\Student\Evaluations;

use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformerInterface;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidatorInterface;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;
use DateTime;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class EvaluationsServiceTest extends TestCase
{
    private EvaluationsService $service;
    private LoggerInterface $logger;
    private UserLessonRepositoryInterface $userLessonRepository;
    private DaysFromToFilterInterface $daysFromToFilter;
    private LessonEvaluationsTransformerInterface $lessonEvaluationsTransformer;
    private LessonEvaluationsValidatorInterface $lessonEvaluationsValidator;
    private TransformerInterface $dateRequestModelTransformer;
    protected function setUp(): void
    {
        parent::setUp();

        $this->logger = $this->createMock(LoggerInterface::class);
        $this->userLessonRepository = $this->createMock(UserLessonRepositoryInterface::class);
        $this->daysFromToFilter = $this->createMock(DaysFromToFilterInterface::class);
        $this->lessonEvaluationsTransformer = $this->createMock(LessonEvaluationsTransformerInterface::class);
        $this->lessonEvaluationsValidator = $this->createMock(LessonEvaluationsValidatorInterface::class);
        $this->dateRequestModelTransformer = $this->createMock(TransformerInterface::class);

        $this->service = new EvaluationsService(
            $this->logger,
            $this->userLessonRepository,
            $this->daysFromToFilter,
            $this->lessonEvaluationsTransformer,
            $this->lessonEvaluationsValidator
        );

        $this->service->setDateRequestModelTransformer($this->dateRequestModelTransformer);
    }

    public function testGetEvaluationsResponseModelCallsAllFunctionsWhenCorrect(): void
    {
        $user = new UserPartial('d3de92e5-ed47-4d49-8811-134c7b293a15', 'Test123');
        $dateArray = ['2022-12-12'];

        $this->dateRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->with($dateArray)
            ->willReturn(new DateRequestModel(new DateTime($dateArray[0])));

        $this->userLessonRepository->expects($this->once())
            ->method('getUserEvaluations');

        $this->daysFromToFilter->expects($this->once())
            ->method('filter');

        $this->lessonEvaluationsValidator->expects($this->once())
            ->method('validate');

        $this->lessonEvaluationsTransformer->expects($this->once())
            ->method('transformToCollection');

        $this->logger->expects($this->never())
            ->method('error');

        $this->service->getEvaluationsResponseModel($user, $dateArray);
    }

    public function testGetEvaluationsResponseModelWhenExceptionThrownLoggerIsCalled(): void
    {
        $user = new UserPartial('d3de92e5-ed47-4d49-8811-134c7b293a15', 'Test123');
        $dateArray = ['2022-12-12'];

        $this->dateRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->with($dateArray)
            ->willReturn(new DateRequestModel(new DateTime($dateArray[0])));

        $this->lessonEvaluationsValidator->expects($this->once())
            ->method('validate')
            ->willThrowException(new ValidatorException());

        $this->logger->expects($this->once())
            ->method('error');

        $this->service->getEvaluationsResponseModel($user, $dateArray);
    }
}
