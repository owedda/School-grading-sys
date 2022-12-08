<?php

namespace App\Service\Grading\Transformers\ResponseModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Grading\ValueObjects\ResponseModel\LessonEvaluationsResponseModel;

interface LessonEvaluationsResponseModelTransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): LessonEvaluationsResponseModel;

    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;
}
