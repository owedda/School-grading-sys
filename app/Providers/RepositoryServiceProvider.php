<?php

namespace App\Providers;

use App\Repositories\Evaluation\EvaluationRepository;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\UserLesson\UserLessonRepository;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserLessonRepositoryInterface::class, UserLessonRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(EvaluationRepositoryInterface::class, EvaluationRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
