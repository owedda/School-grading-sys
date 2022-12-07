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
use App\Service\Grading\Transformers\CustomToDTO\LessonEvaluationsTransformer;
use App\Service\Grading\Transformers\CustomToDTO\StudentEvaluationDTOTransformer;
use App\Service\Grading\Transformers\EntityToModel\LessonModelTransformer;
use App\Service\Grading\Transformers\EntityToModel\UserLessonModelTransformer;
use App\Service\Grading\Transformers\EntityToModel\UserModelTransformer;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(LessonRepositoryInterface::class, function () {
            /** @var LessonRepository $repository */
            $repository = $this->app->make(LessonRepository::class);
            $repository->setLessonTransformer(new LessonModelTransformer());
            return $repository;
        });

        $this->app->bind(EvaluationRepositoryInterface::class, function () {
            /** @var EvaluationRepository $repository */
            $repository = $this->app->make(EvaluationRepository::class);
            return $repository;
        });

        $this->app->bind(UserRepositoryInterface::class, function () {
            /** @var UserRepository $repository */
            $repository = $this->app->make(UserRepository::class);
            $repository->setUserTransformer(new UserModelTransformer());
            return $repository;
        });

        $this->app->bind(UserLessonRepositoryInterface::class, function () {
            /** @var UserLessonRepository $repository */
            $repository = $this->app->make(UserLessonRepository::class);
            $repository->setUserLessonTransformer(new UserLessonModelTransformer());
            $repository->setStudentEvaluationDTOTransformer(new StudentEvaluationDTOTransformer());
            $repository->setLessonEvaluationsTransformer(new LessonEvaluationsTransformer());
            return $repository;
        });
    }
}
