<?php

namespace App\Service\Student\Evaluations;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\RequestModel\DateRequestModel;
use App\Service\Grading\ValueObjects\ResponseModel\MonthResponseModel;

interface EvaluationsServiceInterface
{
    public function getUserEvaluations(string $userId, DateRequestModel $dateRequestModel): DataCollection;

    public function getMonth(DateRequestModel $dateRequestModel): MonthResponseModel;

    public function getDateRequestModelTransformer(): RequestModelTransformerInterface;

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void;
}
