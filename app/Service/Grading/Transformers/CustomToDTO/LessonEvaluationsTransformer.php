<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\CustomDTO\LessonEvaluationsDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\EntityToModel\EvaluationModelTransformer;
use App\Service\Grading\Transformers\TransformerInterface;

final class LessonEvaluationsTransformer implements TransformerInterface
{
    private EvaluationModelTransformer $evaluationDTOTransformer;

    public function __construct()
    {
        $this->evaluationDTOTransformer = new EvaluationModelTransformer();
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformArrayToObject($lesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): LessonEvaluationsDTO
    {
        $this->validateArray($data);

        if (is_null($data['evaluations'])) {
            return $this->getLessonEvaluationsNull($data);
        }
        return $this->getLessonEvaluations($data);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getLessonEvaluations(array $data): LessonEvaluationsDTO
    {
        return new LessonEvaluationsDTO(
            $data['lesson']['name'],
            $this->evaluationDTOTransformer->transformArrayToCollection($data['evaluations'])
        );
    }

    private function getLessonEvaluationsNull(array $data): LessonEvaluationsDTO
    {
        return new LessonEvaluationsDTO(
            $data['lesson']['name']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('evaluations', $data) ||
            !array_key_exists('lesson', $data) ||
            !array_key_exists('name', $data['lesson'])
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
