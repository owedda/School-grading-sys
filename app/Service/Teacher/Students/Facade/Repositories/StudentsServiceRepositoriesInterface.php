<?php

namespace App\Service\Teacher\Students\Facade\Repositories;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;

interface StudentsServiceRepositoriesInterface
{
    public function getUserRepository(): UserRepositoryInterface;

    public function getLessonRepository(): LessonRepositoryInterface;

    public function getUserLessonRepository(): UserLessonRepositoryInterface;
}
