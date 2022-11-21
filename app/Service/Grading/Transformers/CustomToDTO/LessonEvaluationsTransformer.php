<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\LessonEvaluationsDTO;

final class LessonEvaluationsTransformer
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

    public function transformToObject(mixed $data): LessonEvaluationsDTO
    {
        if (is_null($data['evaluations'])) {
            return $this->getLessonEvaluationsNull($data);
        }
        return $this->getLessonEvaluations($data);
    }

    private function getLessonEvaluations(mixed $data): LessonEvaluationsDTO
    {
        return new LessonEvaluationsDTO(
            $data['lesson']['name'],
            $this->evaluationDTOTransformer->transformArrayToCollection($data['evaluations'])
        );
    }

    private function getLessonEvaluationsNull(mixed $data): LessonEvaluationsDTO
    {
        return new LessonEvaluationsDTO(
            $data['lesson']['name']
        );
    }
}
