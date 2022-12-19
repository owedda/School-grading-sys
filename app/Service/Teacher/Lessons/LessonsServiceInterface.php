<?php

namespace App\Service\Teacher\Lessons;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\UsersResponseModel;

interface LessonsServiceInterface
{
    public function getAllLessons(): DataCollection;

    public function getUsersResponseModel(string $lessonId, array $date): UsersResponseModel;

    public function destroyEvaluation(string $evaluationId): void;

    public function storeEvaluation(array $evaluation): void;
}
