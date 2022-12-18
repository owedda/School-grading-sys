<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Models\UserLesson;
use App\Models\UserTypeEnum;
use App\Service\Shared\DTO\RequestModel\UserLessonRequestModel;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;
use DateTime;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(
        private readonly UserLesson $userLesson
    ) {
    }

    public function deleteElementById(string $id): void
    {
        $this->userLesson->destroy($id);
    }

    public function save(UserLessonRequestModel $requestModel): void
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $requestModel->getUserId();
        $userLesson->lesson_id = $requestModel->getLessonId();
        $userLesson->save();
    }

    public function getStudentsWithEvaluationsInConcreteLesson(string $lessonId, DateTime $date): array
    {
        return $this->userLesson
            ::where(DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID, $lessonId)
            ->with(RelationshipConstants::USERLESSON_USER, function ($user) {
                $user->where(DatabaseConstants::USERS_TABLE_TYPE, UserTypeEnum::Student);
            })
            ->with(RelationshipConstants::USERLESSON_EVALUATION, function ($evaluation) use ($date) {
                $evaluation->where(DatabaseConstants::EVALUATIONS_TABLE_DATE, $date);
            })
            ->get()
            ->toArray();
    }

    public function getUserEvaluations(string $userId, DateRange $dateRange): array
    {
        return $this->userLesson
            ::where(DatabaseConstants::USER_LESSONS_TABLE_USER_ID, $userId)
            ->with(RelationshipConstants::USERLESSON_LESSON)
            ->with(RelationshipConstants::USERLESSON_EVALUATIONS, function ($evaluations) use ($dateRange) {
                $evaluations
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '>=', $dateRange->getDateFrom())
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '<=', $dateRange->getDateTo());
            })
            ->get()
            ->toArray();
    }
}
