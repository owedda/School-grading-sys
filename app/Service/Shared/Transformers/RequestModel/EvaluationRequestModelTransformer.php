<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformers\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;

final class EvaluationRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): EvaluationRequestModel
    {
        return new EvaluationRequestModel(
            (int)$data[RequestConstants::EVALUATION_REQUEST_VALUE],
            $data[RequestConstants::EVALUATION_REQUEST_USER_LESSON_ID],
            $data[RequestConstants::EVALUATION_REQUEST_DATE]
        );
    }
}
