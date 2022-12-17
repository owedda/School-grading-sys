<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;
use App\Service\Shared\Transformer\TransformerToObjectInterface;

final class EvaluationRequestModelTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): EvaluationRequestModel
    {
        return new EvaluationRequestModel(
            (int)$data[RequestConstants::EVALUATION_REQUEST_VALUE],
            $data[RequestConstants::EVALUATION_REQUEST_USER_LESSON_ID],
            $data[RequestConstants::EVALUATION_REQUEST_DATE]
        );
    }
}
