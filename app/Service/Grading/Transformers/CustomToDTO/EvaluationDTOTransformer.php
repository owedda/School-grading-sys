<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\EvaluationDTO;
use App\Service\Grading\Transformers\TransformerInterface;
use DateTime;

final class EvaluationDTOTransformer implements TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $evaluationDTO) {
            $collection->add($this->transformToObject($evaluationDTO));
        }

        return $collection;
    }

    public function transformToObject(array $data): EvaluationDTO
    {
        return new EvaluationDTO(
            $data['value'],
            (new DateTime($data['date']))->format('d'),
        );
    }
}
