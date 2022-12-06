<?php

declare(strict_types=1);

namespace App\Repositories\Evaluation;

use App\Models\Evaluation;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\CustomDTO\DateRangeDTO;
use App\Service\Grading\DTO\StoreDTO\EvaluationStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

final class EvaluationRepository implements EvaluationRepositoryInterface
{
    private TransformerInterface $lessonEvaluationsTransformer;

    public function __construct(
        private readonly Evaluation $evaluation,
        private readonly UserLesson $userLesson
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

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRangeDTO $dateRange): DataCollection
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

    public function setLessonEvaluationsTransformer(TransformerInterface $lessonEvaluationsTransformer): void
    {
        $this->lessonEvaluationsTransformer = $lessonEvaluationsTransformer;
    }
}
