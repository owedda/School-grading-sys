<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Constants\DatabaseConstants;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    private TransformerInterface $studentEvaluationDTOTransformer;
    private TransformerInterface $lessonEvaluationsTransformer;

    public function __construct(private readonly UserLesson $userLesson)
    {
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
    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection
    {
        $arrayUserLessonsWithUsers = $this->userLesson
            ::where(DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID, $lessonId)
            ->with('user')
            ->with('evaluation', function ($evaluation) use ($date) {
                $evaluation->where(DatabaseConstants::EVALUATIONS_TABLE_DATE, $date);
            })
            ->get()
            ->toArray();

        return new DataCollection(
            $this->studentEvaluationDTOTransformer
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
            ->with('lesson')
            ->with('evaluations', function ($evaluations) use ($dateRange) {
                $evaluations
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '>=', $dateRange->getDateFrom())
                    ->whereDate(DatabaseConstants::EVALUATIONS_TABLE_DATE, '<=', $dateRange->getDateTo());
            })
            ->get()
            ->toArray();

        return $this->lessonEvaluationsTransformer->transformArrayToCollection($arrayOfUserEvaluations);
    }

    public function setStudentEvaluationDTOTransformer(TransformerInterface $studentEvaluationDTOTransformer): void
    {
        $this->studentEvaluationDTOTransformer = $studentEvaluationDTOTransformer;
    }

    public function setLessonEvaluationsTransformer(TransformerInterface $lessonEvaluationsTransformer): void
    {
        $this->lessonEvaluationsTransformer = $lessonEvaluationsTransformer;
    }
}
