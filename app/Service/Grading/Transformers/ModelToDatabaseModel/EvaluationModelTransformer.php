<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDatabaseModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\DatabaseModel\EvaluationModel;
use DateTime;

final class EvaluationModelTransformer implements TransformerInterface
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
    public function transformArrayToObject(array $data): EvaluationModel
    {
        $this->validateArray($data);

        return new EvaluationModel(
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
            !array_key_exists('date', $data) ||
            !is_int($data['value'])
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
