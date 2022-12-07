<?php

namespace App\Service\Teacher\Students;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserModel;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;
use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;

interface StudentsServiceInterface
{
    public function getAll(): DataCollection;

    public function getStudent(string $userId): UserModel;

    public function getStudentLessons(string $userId): DataCollection;

    public function store(UserRequestModel $userRequestDTO): void;

    public function delete(string $userId): void;

    public function storeUserLesson(UserLessonRequestModel $userLessonRequestModel): void;

    public function destroyUserLesson(string $userLessonId): void;

    public function setUserLessonRequestModelTransformer(
        RequestModelTransformerInterface $userLessonRequestModelTransformer
    ): void;

    public function getUserLessonRequestModelTransformer(): RequestModelTransformerInterface;

    public function getUserRequestModelTransformer(): RequestModelTransformerInterface;

    public function setUserRequestModelTransformer(RequestModelTransformerInterface $userRequestModelTransformer): void;
}
