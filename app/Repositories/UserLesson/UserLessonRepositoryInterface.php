<?php

namespace App\Repositories\UserLesson;

use App\Service\Shared\DTO\RequestModel\UserLessonRequestModel;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;
use DateTime;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonRequestModel $requestModel): void;

    public function getStudentsWithEvaluationsInConcreteLesson(string $lessonId, DateTime $date): array;

    public function getUserEvaluations(string $userId, DateRange $dateRange): array;
}
