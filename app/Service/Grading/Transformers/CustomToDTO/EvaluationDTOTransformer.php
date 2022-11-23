<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\EvaluationDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use DateTime;

final class EvaluationDTOTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $evaluationDTO) {
            $collection->add($this->transformArrayToObject($evaluationDTO));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): EvaluationDTO
    {
        $this->validateArray($data);

        return new EvaluationDTO(
            $data['value'],
            (new DateTime($data['date']))->format('d'),
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('value', $data) ||
            !array_key_exists('date', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
