<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\DTO\Custom;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;

final class LessonEvaluations
{
    public function __construct(
        private readonly UserLessonModel $userLesson,
        private readonly LessonModel $lesson,
        private readonly DataCollection $evaluations
    ) {
    }

    public function getUserLesson(): UserLessonModel
    {
        return $this->userLesson;
    }

    public function getLesson(): LessonModel
    {
        return $this->lesson;
    }

    public function getEvaluations(): DataCollection
    {
        return $this->evaluations;
    }
}
