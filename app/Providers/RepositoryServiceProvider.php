<?php

namespace App\Providers;

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
    }

    public function boot(): void
    {
        //
    }
}
