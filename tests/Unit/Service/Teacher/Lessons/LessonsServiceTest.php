<?php

namespace Service\Teacher\Lessons;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\Facade\ErrorHandler\LessonsServiceErrorHandlerInterface;
use App\Service\Teacher\Lessons\Facade\Repositories\LessonsServiceRepositoriesInterface;
use App\Service\Teacher\Lessons\Facade\Transformers\LessonsServiceTransformersInterface;
use App\Service\Teacher\Lessons\LessonsService;
use PHPUnit\Framework\TestCase;

class LessonsServiceTest extends TestCase
{
    private LessonsService $service;
    private LessonsServiceRepositoriesInterface $repositories;
    private LessonsServiceErrorHandlerInterface $errorHandler;
    private LessonsServiceTransformersInterface $transformers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositories = $this->createMock(LessonsServiceRepositoriesInterface::class);
        $this->errorHandler = $this->createMock(LessonsServiceErrorHandlerInterface::class);
        $this->transformers = $this->createMock(LessonsServiceTransformersInterface::class);

        $this->service = new LessonsService(
            $this->repositories,
            $this->errorHandler,
            $this->transformers
        );
    }

    public function testDestroyEvaluationCallsFunction(): void
    {
        $id = '00000000-0000-0000-0000-000000000000';

        $this->repositories->expects($this->once())
            ->method('getEvaluationRepository');

        $this->service->destroyEvaluation($id);
    }

    public function testStoreEvaluationCallsAllFunctions(): void
    {
        $value = 5;
        $userLessonId = '00000000-0000-0000-0000-000000000000';
        $date = "2022-12-20";
        $evaluationRequestModel = new EvaluationRequestModel($value, $userLessonId, $date);
        $evaluationRequestModelTransformer = $this->createMock(TransformerToObjectInterface::class);

        $evaluationRequestModelTransformer->expects($this->once())
            ->method('transformToObject')
            ->willReturn($evaluationRequestModel);

        $this->transformers->expects($this->once())
            ->method('getEvaluationRequestModelTransformer')
            ->willReturn($evaluationRequestModelTransformer);

        $this->repositories->expects($this->once())
            ->method('getEvaluationRepository');

        $this->service->storeEvaluation([]);
    }

    public function testGetAllLessonsCallsAllFunctionsWhenCorrect(): void
    {
        $lessonRepository = $this->createMock(LessonRepositoryInterface::class);
        $lessonTransformer = $this->createMock(TransformerInterface::class);

        $lessonRepository->expects($this->once())
            ->method('getAll');

        $lessonTransformer->expects($this->once())
            ->method('transformToCollection');

        $this->repositories->expects($this->once())
            ->method('getLessonRepository')
            ->willReturn($lessonRepository);

        $this->transformers->expects($this->once())
            ->method('getLessonTransformer')
            ->willReturn($lessonTransformer);

        $this->errorHandler->expects($this->once())
            ->method('handleLessons');

        $this->service->getAllLessons();
    }
}
