<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    private TransformerInterface $userLessonTransformer;
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
    public function getAllByUserId(string $userId): DataCollection
    {
        $arrayUserLessons = $this->userLesson
            ::where('user_id', $userId)
            ->get()
            ->toArray();

        return $this->userLessonTransformer->transformArrayToCollection($arrayUserLessons);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection
    {
        $arrayUserLessonsWithUsers = $this->userLesson
            ::where('lesson_id', $lessonId)
            ->with('user')
            ->with('evaluation', function ($evaluation) use ($date) {
                $evaluation->where('date', $date);
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
            ::where('user_id', $userId)
            ->with('lesson')
            ->with('evaluations', function ($evaluations) use ($dateRange) {
                $evaluations
                    ->whereDate('date', '>=', $dateRange->getDateFrom())
                    ->whereDate('date', '<=', $dateRange->getDateTo());
            })
            ->get()
            ->toArray();

        return $this->lessonEvaluationsTransformer->transformArrayToCollection($arrayOfUserEvaluations);
    }

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void
    {
        $this->userLessonTransformer = $userLessonTransformer;
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
