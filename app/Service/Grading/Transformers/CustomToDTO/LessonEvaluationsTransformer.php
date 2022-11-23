<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\LessonEvaluationsDTO;
use App\Service\Grading\Transformers\TransformerInterface;

final class LessonEvaluationsTransformer implements TransformerInterface
{
    private EvaluationDTOTransformer $evaluationDTOTransformer;

    public function __construct()
    {
        $this->evaluationDTOTransformer = new EvaluationDTOTransformer();
    }

    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformToObject($lesson));
        }

        return $collection;
    }

    public function transformToObject(array $data): LessonEvaluationsDTO
    {
        if (is_null($data['evaluations'])) {
            return $this->getLessonEvaluationsNull($data);
        }
        return $this->getLessonEvaluations($data);
    }

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
}
