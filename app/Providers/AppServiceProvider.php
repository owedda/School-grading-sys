<?php

namespace App\Providers;

use App\Http\Controllers\Student\EvaluationController;
use App\Http\Controllers\Teacher\LessonsController;
use App\Service\Grading\Filter\DaysFromToFilter;
use App\Service\Grading\Filter\DaysFromToFilterInterface;
use App\Service\Grading\Filter\StudentAttendingLessonsFilter;
use App\Service\Grading\Filter\StudentAttendingLessonsFilterInterface;
use App\Service\Grading\Transformers\RequestModel\EvaluationRequestModelTransformer;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\Transformers\RequestModel\UserLessonRequestModelTransformer;
use App\Service\Grading\Transformers\RequestModel\UserRequestModelTransformer;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\LessonsService;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use App\Service\Teacher\Students\StudentsService;
use App\Service\Teacher\Students\StudentsServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(LessonsServiceInterface::class, LessonsService::class);

        $this->app->bind(DaysFromToFilterInterface::class, DaysFromToFilter::class);
        $this->app->bind(StudentAttendingLessonsFilterInterface::class, StudentAttendingLessonsFilter::class);

        $this->app->bind(StudentsServiceInterface::class, function () {
            /** @var StudentsService $service */
            $service = $this->app->make(StudentsService::class);
            $service->setUserRequestModelTransformer(new UserRequestModelTransformer());
            $service->setUserLessonRequestModelTransformer(new UserLessonRequestModelTransformer());
            return $service;
        });

        $this->app->when(EvaluationController::class)
            ->needs(TransformerToObjectInterface::class)
            ->give(function () {
                return new EvaluationRequestModelTransformer();
            });

        $this->app->when(LessonsController::class)
            ->needs(RequestModelTransformerInterface::class)
            ->give(function () {
                return new EvaluationRequestModelTransformer();
            });
    }
}
