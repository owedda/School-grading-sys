<?php

namespace App\Service\Student\Evaluations;

use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Student\Evaluations\DTO\ResponseModel\EvaluationsResponseModel;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;

interface EvaluationsServiceInterface
{
    public function getEvaluationsResponseModel(UserPartial $user, array $date): EvaluationsResponseModel;
}
