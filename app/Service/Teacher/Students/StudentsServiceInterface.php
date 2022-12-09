<?php

namespace App\Service\Teacher\Students;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Teacher\Students\DTO\ResponseModel\StudentLessonsResponseModel;

interface StudentsServiceInterface
{
    public function getAll(): DataCollection;

    public function getStudentLessons(string $userId): StudentLessonsResponseModel;

    public function store(array $user): void;

    public function delete(string $userId): void;

    public function storeUserLesson(array $userLesson): void;

    public function destroyUserLesson(string $userLessonId): void;

    public function setUserLessonRequestModelTransformer(
        RequestModelTransformerInterface $userLessonRequestModelTransformer
    ): void;

    public function setUserRequestModelTransformer(RequestModelTransformerInterface $userRequestModelTransformer): void;

    public function setUserTransformer(TransformerInterface $userTransformer): void;
}
