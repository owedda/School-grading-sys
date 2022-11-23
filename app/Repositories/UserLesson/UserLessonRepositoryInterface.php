<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\DTO\UserLessonStoreDTO;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonStoreDTO $requestDTO): void;
}
