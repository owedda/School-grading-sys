<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\ResponseModel\LessonEvaluationsResponseModelTransformerInterface;
use App\Service\Grading\Transformers\ResponseModel\StudentEvaluationResponseModelTransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;
use DateTime;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(
        private readonly UserLesson $userLesson,
        private readonly StudentEvaluationResponseModelTransformerInterface $studentEvaluationResponseModelTransformer,
        private readonly LessonEvaluationsResponseModelTransformerInterface $lessonEvaluationsResponseModelTransformer
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

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, DateTime $date): DataCollection
    {
        $arrayUserLessonsWithUsers = $this->userLesson
            ::where(DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID, $lessonId)
            ->with(RelationshipConstants::USERLESSON_USER)
            ->with(RelationshipConstants::USERLESSON_EVALUATION, function ($evaluation) use ($date) {
                $evaluation->where(DatabaseConstants::EVALUATIONS_TABLE_DATE, $date);
            })
            ->get()
            ->toArray();

        return new DataCollection(
            $this->studentEvaluationResponseModelTransformer
                ->transformArrayToCollection($arrayUserLessonsWithUsers)
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRange $dateRange): DataCollection
    {
        $arrayOfUserEvaluations = $this->userLesson
            ::where(DatabaseConstants::USER_LESSONS_TABLE_USER_ID, $userId)
            ->with(RelationshipConstants::USERLESSON_LESSON)
            ->with(RelationshipConstants::USERLESSON_EVALUATIONS, function ($evaluations) use ($dateRange) {
                $evaluations
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '>=', $dateRange->getDateFrom())
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '<=', $dateRange->getDateTo());
            })
            ->get()
            ->toArray();

        return $this->lessonEvaluationsResponseModelTransformer->transformArrayToCollection($arrayOfUserEvaluations);
    }
}
