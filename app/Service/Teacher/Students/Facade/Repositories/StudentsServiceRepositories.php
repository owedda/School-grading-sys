<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\Facade\Repositories;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;

final class StudentsServiceRepositories implements StudentsServiceRepositoriesInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository
    ) {
    }

    public function getUserRepository(): UserRepositoryInterface
    {
        return $this->userRepository;
    }

    public function getLessonRepository(): LessonRepositoryInterface
    {
        return $this->lessonRepository;
    }

    public function getUserLessonRepository(): UserLessonRepositoryInterface
    {
        return $this->userLessonRepository;
    }
}
