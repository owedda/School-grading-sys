<?php

declare(strict_types=1);

namespace App\Service\Grading\ValueObjects\ResponseModel;

use App\Service\Grading\ValueObjects\Model\LessonModel;
use App\Service\Grading\ValueObjects\Model\UserLessonModel;

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
