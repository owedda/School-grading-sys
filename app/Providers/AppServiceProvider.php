<?php

namespace App\Providers;

use App\Service\Grading\Filter\DaysFromToFilter;
use App\Service\Grading\Filter\DaysFromToFilterInterface;
use App\Service\Grading\Transformers\EntityToModel\EvaluationModelTransformer;
use App\Service\Grading\Transformers\EntityToModel\LessonModelTransformer;
use App\Service\Grading\Transformers\EntityToModel\UserLessonModelTransformer;
use App\Service\Grading\Transformers\EntityToModel\UserModelTransformer;
use App\Service\Grading\Transformers\RequestModel\DateRequestModelTransformer;
use App\Service\Grading\Transformers\RequestModel\EvaluationRequestModelTransformer;
use App\Service\Grading\Transformers\RequestModel\UserLessonRequestModelTransformer;
use App\Service\Grading\Transformers\RequestModel\UserRequestModelTransformer;
use App\Service\Grading\Transformers\ResponseModel\LessonEvaluationsResponseModelTransformer;
use App\Service\Grading\Transformers\ResponseModel\LessonEvaluationsResponseModelTransformerInterface;
use App\Service\Grading\Transformers\ResponseModel\StudentEvaluationResponseModelTransformer;
use App\Service\Grading\Transformers\ResponseModel\StudentEvaluationResponseModelTransformerInterface;
use App\Service\Grading\Transformers\ResponseModel\UserAttendedLessonResponseModelTransformer;
use App\Service\Grading\Transformers\ResponseModel\UserAttendedLessonResponseModelTransformerInterface;
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
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
        $this->app->bind(DaysFromToFilterInterface::class, DaysFromToFilter::class);

        $this->app->bind(UserAttendedLessonResponseModelTransformerInterface::class, function () {
            /** @var UserAttendedLessonResponseModelTransformer $transformer */
            $transformer = $this->app->make(UserAttendedLessonResponseModelTransformer::class);
            $transformer->setLessonTransformerToObject(new LessonModelTransformer());
            $transformer->setUserLessonTransformerToObject(new UserLessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(StudentEvaluationResponseModelTransformerInterface::class, function () {
            /** @var StudentEvaluationResponseModelTransformer $transformer */
            $transformer = $this->app->make(StudentEvaluationResponseModelTransformer::class);
            $transformer->setUserTransformerToObject(new UserModelTransformer());
            $transformer->setEvaluationTransformerToObject(new EvaluationModelTransformer());
            $transformer->setUserLessonTransformerToObject(new UserLessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(LessonEvaluationsResponseModelTransformerInterface::class, function () {
            /** @var LessonEvaluationsResponseModelTransformer $transformer */
            $transformer = $this->app->make(LessonEvaluationsResponseModelTransformer::class);
            $transformer->setEvaluationTransformer(new EvaluationModelTransformer());
            $transformer->setUserLessonTransformer(new UserLessonModelTransformer());
            $transformer->setLessonTransformer(new LessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(StudentsServiceInterface::class, function () {
            /** @var StudentsService $service */
            $service = $this->app->make(StudentsService::class);
            $service->setUserRequestModelTransformer(new UserRequestModelTransformer());
            $service->setUserLessonRequestModelTransformer(new UserLessonRequestModelTransformer());
            return $service;
        });

        $this->app->bind(LessonsServiceInterface::class, function () {
            /** @var LessonsService $service */
            $service = $this->app->make(LessonsService::class);
            $service->setEvaluationRequestModelTransformer(new EvaluationRequestModelTransformer());
            $service->setDateRequestModelTransformer(new DateRequestModelTransformer());
            return $service;
        });

        $this->app->bind(EvaluationsServiceInterface::class, function () {
            /** @var EvaluationsService $service */
            $service = $this->app->make(EvaluationsService::class);
            $service->setDateRequestModelTransformer(new DateRequestModelTransformer());
            return $service;
        });
    }
}
