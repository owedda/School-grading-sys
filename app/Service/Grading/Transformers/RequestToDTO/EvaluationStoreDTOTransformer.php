<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\EvaluationStoreDTO;
use Date;

final class EvaluationStoreDTOTransformer
{
    public function transformToObject(mixed $data): EvaluationStoreDTO
    {
        return new EvaluationStoreDTO(
            (int)$data['value'],
            $data['user-lesson-id'],
            $data['date']
        );
    }
}
