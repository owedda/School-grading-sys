<?php

namespace App\Service\Teacher\Lessons\Facade\Repositories;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;

interface LessonsServiceRepositoriesInterface
{
    public function getLessonRepository(): LessonRepositoryInterface;

    public function getUserLessonRepository(): UserLessonRepositoryInterface;

    public function getEvaluationRepository(): EvaluationRepositoryInterface;
}
