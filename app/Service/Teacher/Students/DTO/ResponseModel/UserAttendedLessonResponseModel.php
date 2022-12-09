<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\DTO\ResponseModel;

use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;

final class UserAttendedLessonResponseModel
{
    public function __construct(
        private readonly LessonModel $lessonModel,
        private readonly ?UserLessonModel $userLessonModel = null
    ) {
    }

    public function getLessonModel(): LessonModel
    {
        return $this->lessonModel;
    }

    public function getUserLessonModel(): UserLessonModel|null
    {
        return $this->userLessonModel;
    }
}
