<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonRequestModel $requestModel): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllByUserId(string $userId): DataCollection;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;

    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection;
}
