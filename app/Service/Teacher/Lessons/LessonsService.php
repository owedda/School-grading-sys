<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;

final class LessonsService implements LessonsServiceInterface
{
    public function __construct(private readonly LessonRepositoryInterface $lessonRepository)
    {
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
}
