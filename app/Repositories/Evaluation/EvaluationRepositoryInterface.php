<?php

namespace App\Repositories\Evaluation;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\EvaluationStoreDTO;
use DateTime;

interface EvaluationRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(EvaluationStoreDTO $requestDTO): void;

    public function getUserEvaluations(string $userId, DateTime $dateFrom, DateTime $dateTo): DataCollection;
}
