<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\EvaluationStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class EvaluationStoreDTOTransformer implements TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): EvaluationStoreDTO
    {
        $this->validateArray($data);

        return new EvaluationStoreDTO(
            (int)$data['value'],
            $data['user-lesson-id'],
            $data['date']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('value', $data) ||
            !array_key_exists('user-lesson-id', $data) ||
            !array_key_exists('date', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
