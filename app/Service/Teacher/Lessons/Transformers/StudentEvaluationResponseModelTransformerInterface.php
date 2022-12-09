<?php

namespace App\Service\Teacher\Lessons\Transformers;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\StudentEvaluationResponseModel;

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
