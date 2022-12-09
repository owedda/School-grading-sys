<?php

namespace App\Repositories\Evaluation;

use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;

interface EvaluationRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(EvaluationRequestModel $requestDTO): void;
}
