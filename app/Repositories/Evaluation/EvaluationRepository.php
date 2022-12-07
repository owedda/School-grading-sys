<?php

declare(strict_types=1);

namespace App\Repositories\Evaluation;

use App\Models\Evaluation;
use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

final class EvaluationRepository implements EvaluationRepositoryInterface
{
    public function __construct(private readonly Evaluation $evaluation)
    {
    }

    public function deleteElementById(string $id): void
    {
        $this->evaluation->destroy($id);
    }

    public function save(EvaluationRequestModel $requestDTO): void
    {
        $evaluation = new Evaluation();
        $evaluation->value = $requestDTO->getValue();
        $evaluation->user_lesson_id = $requestDTO->getUserLessonId();
        $evaluation->date = $requestDTO->getDate();
        $evaluation->save();
    }
}
