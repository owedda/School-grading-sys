<?php

namespace App\Providers;

use App\Service\Shared\Transformers\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\UserModelTransformer;
use App\Service\Shared\Transformers\RequestModel\DateRequestModelTransformer;
use App\Service\Shared\Transformers\RequestModel\EvaluationRequestModelTransformer;
use App\Service\Shared\Transformers\RequestModel\UserLessonRequestModelTransformer;
use App\Service\Shared\Transformers\RequestModel\UserRequestModelTransformer;
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
use App\Service\Student\Evaluations\Filter\DaysFromToFilter;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Student\Evaluations\Transformers\LessonEvaluationsTransformer;
use App\Service\Student\Evaluations\Transformers\LessonEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\LessonsService;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use App\Service\Teacher\Lessons\Transformers\StudentEvaluationResponseModelTransformer;
use App\Service\Teacher\Lessons\Transformers\StudentEvaluationResponseModelTransformerInterface;
use App\Service\Teacher\Students\StudentsService;
use App\Service\Teacher\Students\StudentsServiceInterface;
use App\Service\Teacher\Students\Transformers\UserAttendedLessonResponseModelTransformer;
use App\Service\Teacher\Students\Transformers\UserAttendedLessonResponseModelTransformerInterface;
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

        $this->app->bind(LessonEvaluationsTransformerInterface::class, function () {
            /** @var LessonEvaluationsTransformer $transformer */
            $transformer = $this->app->make(LessonEvaluationsTransformer::class);
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
            $service->setUserTransformer(new UserModelTransformer());
            return $service;
        });

        $this->app->bind(LessonsServiceInterface::class, function () {
            /** @var LessonsService $service */
            $service = $this->app->make(LessonsService::class);
            $service->setEvaluationRequestModelTransformer(new EvaluationRequestModelTransformer());
            $service->setDateRequestModelTransformer(new DateRequestModelTransformer());
            $service->setLessonTransformer(new LessonModelTransformer());
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
