<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\UserLesson;
use App\Repositories\Lesson\LessonRepository;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\DTO\AttendingLessonDTO;
use App\Service\Grading\DTO\UserLessonStoreDTO;
use App\Service\Grading\Transformers\ModelToDataModel\UserLessonTransformer;

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
