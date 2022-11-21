<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\EvaluationDTO;
use DateTime;

final class EvaluationDTOTransformer
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $evaluationDTO) {
            $collection->add($this->transformToObject($evaluationDTO));
        }

        return $collection;
    }

    public function transformToObject(mixed $data): EvaluationDTO
    {
        return new EvaluationDTO(
            $data['value'],
            (new DateTime($data['date']))->format('d'),
        );
    }
}
