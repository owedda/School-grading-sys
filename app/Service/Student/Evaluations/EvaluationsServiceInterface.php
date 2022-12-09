<?php

namespace App\Service\Student\Evaluations;

use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Student\Evaluations\DTO\ResponseModel\EvaluationsResponseModel;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;

interface EvaluationsServiceInterface
{
    public function getEvaluationsResponseModel(UserPartial $user, array $date): EvaluationsResponseModel;

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void;
}
