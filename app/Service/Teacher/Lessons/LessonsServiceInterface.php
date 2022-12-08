<?php

namespace App\Service\Teacher\Lessons;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\RequestModel\DateRequestModel;
use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

interface LessonsServiceInterface
{
    public function getAll(): DataCollection;

    public function getLesson(string $id);

    public function getUsersInConcreteLesson(string $lessonId, DateRequestModel $dateRequestModel): DataCollection;

    public function storeEvaluation(EvaluationRequestModel $evaluation): void;

    public function destroyEvaluation(string $evaluationId): void;

    public function getEvaluationRequestModelTransformer(): RequestModelTransformerInterface;

    public function setEvaluationRequestModelTransformer(
        RequestModelTransformerInterface $evaluationRequestModelTransformer
    ): void;

    public function getDateRequestModelTransformer(): RequestModelTransformerInterface;

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void;
}
