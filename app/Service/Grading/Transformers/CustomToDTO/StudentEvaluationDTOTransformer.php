<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\StudentEvaluationDTO;
use App\Service\Grading\Transformers\TransformerInterface;

final class StudentEvaluationDTOTransformer implements TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add($this->transformToObject($userLesson));
        }

        return $collection;
    }

    public function transformToObject(array $data): StudentEvaluationDTO
    {
        if (is_null($data['evaluation'])) {
            return $this->getStudentEvaluationDTOWithoutEvaluation($data);
        }
        return $this->getStudentEvaluationDTOFull($data);
    }

    private function getStudentEvaluationDTOWithoutEvaluation(array $data): StudentEvaluationDTO
    {
        return new StudentEvaluationDTO(
            $data['user']['username'],
            $data['user']['name'],
            $data['user']['last_name'],
            $data['id']
        );
    }

    private function getStudentEvaluationDTOFull(array $data): StudentEvaluationDTO
    {
        return new StudentEvaluationDTO(
            $data['user']['username'],
            $data['user']['name'],
            $data['user']['last_name'],
            $data['id'],
            $data['evaluation']['id'],
            $data['evaluation']['value']
        );
    }
}
