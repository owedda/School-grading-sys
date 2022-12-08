<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;
use DateTime;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonRequestModel $requestModel): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, DateTime $date): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRange $dateRange): DataCollection;
}
