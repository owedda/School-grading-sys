<?php

namespace App\Repositories\Lesson;

interface LessonRepositoryInterface
{
    public function getAll(): array;

    public function getAllLessonsWithUserLessonsAttached(string $userId): array;

    public function getElementById(string $id): array;
}
