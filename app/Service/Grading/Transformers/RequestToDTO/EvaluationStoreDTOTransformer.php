<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\EvaluationStoreDTO;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class EvaluationStoreDTOTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): EvaluationStoreDTO
    {
        return new EvaluationStoreDTO(
            (int)$data['value'],
            $data['user-lesson-id'],
            $data['date']
        );
    }
}
