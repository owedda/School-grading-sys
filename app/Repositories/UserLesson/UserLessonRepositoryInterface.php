<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\UserLessonRequestDTO;

interface UserLessonRepositoryInterface
{
    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection;

    public function deleteElementById(string $userLessonId): void;

    public function save(UserLessonRequestDTO $requestDTO): void;

    public function getUsersInConcreteLesson(string $lessonId);
}
