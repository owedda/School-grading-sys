<?php

namespace App\Service\Teacher\Students;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
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
        TransformerToObjectInterface $userLessonRequestModelTransformer
    ): void;

    public function setUserRequestModelTransformer(TransformerToObjectInterface $userRequestModelTransformer): void;

    public function setUserTransformer(TransformerInterface $userTransformer): void;
}
