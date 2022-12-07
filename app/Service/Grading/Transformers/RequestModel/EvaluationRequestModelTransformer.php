<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

final class EvaluationRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): EvaluationRequestModel
    {
        return new EvaluationRequestModel(
            (int)$data['value'],
            $data['user-lesson-id'],
            $data['date']
        );
    }
}
