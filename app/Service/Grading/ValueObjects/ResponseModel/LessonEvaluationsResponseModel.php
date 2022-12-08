<?php

declare(strict_types=1);

namespace App\Service\Grading\ValueObjects\ResponseModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\ValueObjects\Model\LessonModel;
use App\Service\Grading\ValueObjects\Model\UserLessonModel;

final class LessonEvaluationsResponseModel
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
