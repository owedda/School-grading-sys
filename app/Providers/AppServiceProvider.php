<?php

namespace App\Providers;

use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserModelTransformer;
use App\Service\Shared\Transformer\RequestModel\DateRequestModelTransformer;
use App\Service\Shared\Transformer\RequestModel\EvaluationRequestModelTransformer;
use App\Service\Shared\Transformer\RequestModel\UserLessonRequestModelTransformer;
use App\Service\Shared\Transformer\RequestModel\UserRequestModelTransformer;
use App\Service\Shared\Validator\Model\EvaluationModelValidator;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
use App\Service\Shared\Validator\Model\UserModelValidator;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
use App\Service\Student\Evaluations\Filter\DaysFromToFilter;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformer;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformerInterface;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidator;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidatorInterface;
use App\Service\Teacher\Lessons\LessonsService;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformer;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidator;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;
use App\Service\Teacher\Students\StudentsService;
use App\Service\Teacher\Students\StudentsServiceInterface;
use App\Service\Teacher\Students\Transformer\UserAttendedLessonResponseModelTransformer;
use App\Service\Teacher\Students\Transformer\UserAttendedLessonResponseModelTransformerInterface;
use App\Service\Teacher\Students\Validator\UserAttendedLessonResponseModelValidator;
use App\Service\Teacher\Students\Validator\UserAttendedLessonResponseModelValidatorInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(DaysFromToFilterInterface::class, DaysFromToFilter::class);

        $this->app->bind(LessonEvaluationsValidatorInterface::class, function () {
            /** @var LessonEvaluationsValidator $validator */
            $validator = $this->app->make(LessonEvaluationsValidator::class);
            $validator->setEvaluationModelValidator(new EvaluationModelValidator());
            $validator->setLessonModelValidator(new LessonModelValidator());
            $validator->setUserLessonModelValidator(new UserLessonModelValidator());
            return $validator;
        });

        $this->app->bind(StudentEvaluationsValidatorInterface::class, function () {
            /** @var StudentEvaluationsValidator $validator */
            $validator = $this->app->make(StudentEvaluationsValidator::class);
            $validator->setEvaluationModelValidator(new EvaluationModelValidator());
            $validator->setUserModelValidator(new UserModelValidator());
            $validator->setUserLessonModelValidator(new UserLessonModelValidator());
            return $validator;
        });

        $this->app->bind(UserAttendedLessonResponseModelValidatorInterface::class, function () {
            /** @var UserAttendedLessonResponseModelValidator $validator */
            $validator = $this->app->make(UserAttendedLessonResponseModelValidator::class);
            $validator->setLessonModelValidator(new LessonModelValidator());
            $validator->setUserLessonModelValidator(new UserLessonModelValidator());
            return $validator;
        });

        $this->app->bind(UserAttendedLessonResponseModelTransformerInterface::class, function () {
            /** @var UserAttendedLessonResponseModelTransformer $transformer */
            $transformer = $this->app->make(UserAttendedLessonResponseModelTransformer::class);
            $transformer->setLessonTransformer(new LessonModelTransformer());
            $transformer->setUserLessonTransformer(new UserLessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(StudentEvaluationsTransformerInterface::class, function () {
            /** @var StudentEvaluationsTransformer $transformer */
            $transformer = $this->app->make(StudentEvaluationsTransformer::class);
            $transformer->setUserTransformer(new UserModelTransformer());
            $transformer->setEvaluationTransformer(new EvaluationModelTransformer(new EvaluationModelValidator()));
            $transformer->setUserLessonTransformer(new UserLessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(LessonEvaluationsTransformerInterface::class, function () {
            /** @var LessonEvaluationsTransformer $transformer */
            $transformer = $this->app->make(LessonEvaluationsTransformer::class);
            $transformer->setEvaluationTransformer(new EvaluationModelTransformer(new EvaluationModelValidator()));
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
            $service->setUserModelValidator(new UserModelValidator());
            return $service;
        });

        $this->app->bind(LessonsServiceInterface::class, function () {
            /** @var LessonsService $service */
            $service = $this->app->make(LessonsService::class);
            $service->setEvaluationRequestModelTransformer(new EvaluationRequestModelTransformer());
            $service->setDateRequestModelTransformer(new DateRequestModelTransformer());
            $service->setLessonTransformer(new LessonModelTransformer());
            $service->setLessonModelValidator(new LessonModelValidator());
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
