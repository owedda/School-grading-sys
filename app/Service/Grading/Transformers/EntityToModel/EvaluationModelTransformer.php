<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\EvaluationModel;
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
            $data[DatabaseConstants::EVALUATIONS_TABLE_ID],
            $data[DatabaseConstants::EVALUATIONS_TABLE_VALUE],
            new DateTime($data[DatabaseConstants::EVALUATIONS_TABLE_DATE]),
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists(DatabaseConstants::EVALUATIONS_TABLE_VALUE, $data) ||
            !array_key_exists(DatabaseConstants::EVALUATIONS_TABLE_DATE, $data) ||
            !is_int($data[DatabaseConstants::EVALUATIONS_TABLE_VALUE])
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
