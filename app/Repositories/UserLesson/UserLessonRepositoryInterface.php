<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\UserLessonStoreDTO;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $userLessonId): void;

    public function save(UserLessonStoreDTO $requestDTO): void;
}
