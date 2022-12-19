<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Facade\Repositories;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;

final class LessonsServiceRepositories implements LessonsServiceRepositoriesInterface
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly EvaluationRepositoryInterface $evaluationRepository
    ) {
    }

    public function getLessonRepository(): LessonRepositoryInterface
    {
        return $this->lessonRepository;
    }

    public function getUserLessonRepository(): UserLessonRepositoryInterface
    {
        return $this->userLessonRepository;
    }

    public function getEvaluationRepository(): EvaluationRepositoryInterface
    {
        return $this->evaluationRepository;
    }
}
