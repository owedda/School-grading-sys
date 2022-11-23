<?php

namespace App\Providers;

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserLessonController;
use App\Service\Grading\Transformers\RequestToDTO\EvaluationStoreDTOTransformer;
use App\Service\Grading\Transformers\RequestToDTO\UserLessonStoreDTOTransformer;
use App\Service\Grading\Transformers\RequestToDTO\UserStoreDTOTransformer;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->when(EvaluationController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new EvaluationStoreDTOTransformer();
            });

        $this->app->when(StudentController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new UserStoreDTOTransformer();
            });

        $this->app->when(UserLessonController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new UserLessonStoreDTOTransformer();
            });
    }
}
