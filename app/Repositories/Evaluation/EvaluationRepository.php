<?php

declare(strict_types=1);

namespace App\Repositories\Evaluation;

use App\Models\Evaluation;
use App\Models\Lesson;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\EvaluationStoreDTO;
use App\Service\Grading\Transformers\CustomToDTO\LessonEvaluationsTransformer;
use DateTime;

final class EvaluationRepository implements EvaluationRepositoryInterface
{
    public function __construct(
        private readonly Evaluation $evaluation,
        private readonly LessonEvaluationsTransformer $lessonEvaluationsTransformer
    ) {
    }

    public function deleteElementById(string $id): void
    {
        $this->evaluation->destroy($id);
    }

    public function save(EvaluationStoreDTO $requestDTO): void
    {
        $evaluation = new Evaluation();
        $evaluation->value = $requestDTO->getValue();
        $evaluation->user_lesson_id = $requestDTO->getUserLessonId();
        $evaluation->date = $requestDTO->getDate();
        $evaluation->save();
    }

    public function getUserEvaluations(string $userId, DateTime $dateFrom, DateTime $dateTo): DataCollection
    {
        $arrayOfUserEvaluations = UserLesson::where('user_id', $userId)->with('lesson')->with('evaluations', function ($q) use ($dateFrom, $dateTo) {
                $q->whereDate('date', '>=' , $dateFrom)->whereDate('date', '<=' , $dateTo);
            })->get()->toArray();

        return $this->lessonEvaluationsTransformer->transformArrayToCollection($arrayOfUserEvaluations);
    }
}
