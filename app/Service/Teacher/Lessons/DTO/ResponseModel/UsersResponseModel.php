<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\DTO\ResponseModel;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use DateTime;

final class UsersResponseModel
{
    public function __construct(
        private readonly DataCollection $studentsEvaluations,
        private readonly LessonModel $lesson,
        private readonly DateTime $date
    ) {
    }

    public function getStudentsEvaluations(): DataCollection
    {
        return $this->studentsEvaluations;
    }

    public function getLesson(): LessonModel
    {
        return $this->lesson;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
}
