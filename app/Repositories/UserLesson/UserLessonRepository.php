<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\UserLesson;
use App\Service\Grading\DTO\StoreDTO\UserLessonStoreDTO;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(
        private readonly UserLesson $userLesson,
    ) {
    }

    public function deleteElementById(string $id): void
    {
        $this->userLesson->destroy($id);
    }

    public function save(UserLessonStoreDTO $requestDTO): void
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $requestDTO->getUserId();
        $userLesson->lesson_id = $requestDTO->getLessonId();
        $userLesson->save();
    }
}
