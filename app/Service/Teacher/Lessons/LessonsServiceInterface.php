<?php

namespace App\Service\Teacher\Lessons;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;
use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\UsersResponseModel;

interface LessonsServiceInterface
{
    public function getAllLessons(): DataCollection;

    public function getUsersResponseModel(string $lessonId, array $date): UsersResponseModel;

    public function destroyEvaluation(string $evaluationId): void;

    public function storeEvaluation(array $evaluation): void;

    public function setEvaluationRequestModelTransformer(
        RequestModelTransformerInterface $evaluationRequestModelTransformer
    ): void;

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;
}
