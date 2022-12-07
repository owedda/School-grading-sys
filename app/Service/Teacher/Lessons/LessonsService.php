<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\Model\LessonModel;
use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

final class LessonsService implements LessonsServiceInterface
{
    private RequestModelTransformerInterface $evaluationRequestModelTransformer;

    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly EvaluationRepositoryInterface $evaluationRepository
    ) {
    }

    public function getAll(): DataCollection
    {
        return $this->lessonRepository->getAll();
    }

    public function getLesson(string $id): LessonModel
    {
        return $this->lessonRepository->getElementById($id);
    }

    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection
    {
        return $this->userLessonRepository->getUsersInConcreteLesson($lessonId, $date);
    }

    public function storeEvaluation(EvaluationRequestModel $evaluation): void
    {
        $this->evaluationRepository->save($evaluation);
    }

    public function destroyEvaluation(string $evaluationId): void
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
    }

    public function getEvaluationRequestModelTransformer(): RequestModelTransformerInterface
    {
        return $this->evaluationRequestModelTransformer;
    }

    public function setEvaluationRequestModelTransformer(
        RequestModelTransformerInterface $evaluationRequestModelTransformer
    ): void {

        $this->evaluationRequestModelTransformer = $evaluationRequestModelTransformer;
    }
}
