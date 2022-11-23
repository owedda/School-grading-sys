<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\StudentEvaluationDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

final class StudentEvaluationDTOTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add($this->transformArrayToObject($userLesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): StudentEvaluationDTO
    {
        $this->validateArrayHasEvaluation($data);

        if (is_null($data['evaluation'])) {
            return $this->getStudentEvaluationDTOWithoutEvaluation($data);
        }
        return $this->getStudentEvaluationDTOFull($data);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getStudentEvaluationDTOWithoutEvaluation(array $data): StudentEvaluationDTO
    {
        $this->validateArray($data);

        return new StudentEvaluationDTO(
            $data['user']['username'],
            $data['user']['name'],
            $data['user']['last_name'],
            $data['id']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getStudentEvaluationDTOFull(array $data): StudentEvaluationDTO
    {
        $this->validateArray($data);
        $this->validateArrayWithEvaluationElements($data);
        return new StudentEvaluationDTO(
            $data['user']['username'],
            $data['user']['name'],
            $data['user']['last_name'],
            $data['id'],
            $data['evaluation']['id'],
            $data['evaluation']['value']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('user', $data) ||
            !array_key_exists('id', $data) ||
            !array_key_exists('username', $data['user']) ||
            !array_key_exists('name', $data['user']) ||
            !array_key_exists('last_name', $data['user'])
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArrayWithEvaluationElements(array $data): void
    {
        if (
            is_null($data['evaluation']) ||
            !array_key_exists('id', $data['evaluation']) ||
            !array_key_exists('value', $data['evaluation'])
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArrayHasEvaluation(array $data): void
    {
        if (!array_key_exists('evaluation', $data)) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
