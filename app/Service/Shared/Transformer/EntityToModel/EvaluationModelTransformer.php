<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\Transformer\TransformerInterface;
use DateTime;

final class EvaluationModelTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $evaluationDTO) {
            $collection->add($this->transformToObject($evaluationDTO));
        }

        return $collection;
    }

    public function transformToObject(array $data): EvaluationModel
    {
        return new EvaluationModel(
            $data[DatabaseConstants::EVALUATIONS_TABLE_ID],
            $data[DatabaseConstants::EVALUATIONS_TABLE_VALUE],
            new DateTime($data[DatabaseConstants::EVALUATIONS_TABLE_DATE]),
        );
    }
}
