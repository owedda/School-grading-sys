<?php

namespace App\Providers;

use App\Http\Controllers\Student\EvaluationController;
use App\Http\Controllers\Teacher\StudentsController;
use App\Http\Controllers\Teacher\UserLessonController;
use App\Service\Grading\Filter\DaysFromToFilter;
use App\Service\Grading\Filter\DaysFromToFilterInterface;
use App\Service\Grading\Filter\StudentAttendingLessonsFilter;
use App\Service\Grading\Filter\StudentAttendingLessonsFilterInterface;
use App\Service\Grading\Transformers\RequestToDTO\EvaluationStoreDTOTransformer;
use App\Service\Grading\Transformers\RequestToDTO\UserLessonStoreDTOTransformer;
use App\Service\Grading\Transformers\RequestToDTO\UserStoreDTOTransformer;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Student\StudentsService;
use App\Service\Teacher\Student\StudentsServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(DaysFromToFilterInterface::class, DaysFromToFilter::class);
        $this->app->bind(StudentAttendingLessonsFilterInterface::class, StudentAttendingLessonsFilter::class);

        $this->app->when(EvaluationController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new EvaluationStoreDTOTransformer();
            });

        $this->app->when(StudentsController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new UserStoreDTOTransformer();
            });

        $this->app->when(UserLessonController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new UserLessonStoreDTOTransformer();
            });

        $this->app->bind(StudentsServiceInterface::class, StudentsService::class);
    }
}
