<?php

namespace App\Service\Grading\Transformers\ResponseModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Grading\ValueObjects\ResponseModel\StudentEvaluationResponseModel;

interface StudentEvaluationResponseModelTransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): StudentEvaluationResponseModel;

    public function setUserTransformerToObject(TransformerToObjectInterface $userTransformerToObject): void;

    public function setEvaluationTransformerToObject(TransformerToObjectInterface $evaluationTransformerToObject): void;

    public function setUserLessonTransformerToObject(TransformerToObjectInterface $userLessonTransformerToObject): void;
}
