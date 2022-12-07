<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

final class LessonsService implements LessonsServiceInterface
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
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
        return $this->lessonRepository->getUsersInConcreteLesson($lessonId, $date);
    }

    public function storeEvaluation(EvaluationRequestModel $evaluation): void
    {
        $this->evaluationRepository->save($evaluation);
    }

    public function destroyEvaluation(string $evaluationId): void
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
    }
}
