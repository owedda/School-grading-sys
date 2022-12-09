<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\DTO\ResponseModel;

use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\DTO\Model\UserModel;

final class StudentEvaluationResponseModel
{
    public function __construct(
        private readonly UserModel $user,
        private readonly UserLessonModel $userLesson,
        private readonly ?EvaluationModel $evaluation = null,
    ) {
    }

    public function getUser(): UserModel
    {
        return $this->user;
    }

    public function getEvaluation(): EvaluationModel|null
    {
        return $this->evaluation;
    }

    public function getUserLesson(): UserLessonModel
    {
        return $this->userLesson;
    }
}
