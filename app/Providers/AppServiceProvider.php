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
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
use App\Service\Student\Evaluations\Facade\ErrorHandler\EvaluationsServiceErrorHandler;
use App\Service\Student\Evaluations\Facade\ErrorHandler\EvaluationsServiceErrorHandlerInterface;
use App\Service\Student\Evaluations\Facade\Transformers\EvaluationsServiceTransformers;
use App\Service\Student\Evaluations\Facade\Transformers\EvaluationsServiceTransformersInterface;
use App\Service\Student\Evaluations\Filter\DaysFromToFilter;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformer;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformerInterface;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidator;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidatorInterface;
use App\Service\Teacher\Lessons\Facade\ErrorHandler\LessonsServiceErrorHandler;
use App\Service\Teacher\Lessons\Facade\ErrorHandler\LessonsServiceErrorHandlerInterface;
use App\Service\Teacher\Lessons\Facade\Repositories\LessonsServiceRepositories;
use App\Service\Teacher\Lessons\Facade\Repositories\LessonsServiceRepositoriesInterface;
use App\Service\Teacher\Lessons\Facade\Transformers\LessonsServiceTransformers;
use App\Service\Teacher\Lessons\Facade\Transformers\LessonsServiceTransformersInterface;
use App\Service\Teacher\Lessons\LessonsService;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformer;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidator;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;
use App\Service\Teacher\Students\Facade\ErrorHandler\StudentsServiceErrorHandler;
use App\Service\Teacher\Students\Facade\ErrorHandler\StudentsServiceErrorHandlerInterface;
use App\Service\Teacher\Students\Facade\Repositories\StudentsServiceRepositories;
use App\Service\Teacher\Students\Facade\Repositories\StudentsServiceRepositoriesInterface;
use App\Service\Teacher\Students\Facade\Transformers\StudentsServiceTransformers;
use App\Service\Teacher\Students\Facade\Transformers\StudentsServiceTransformersInterface;
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

        $this->app->bind(LessonsServiceRepositoriesInterface::class, LessonsServiceRepositories::class);
        $this->app->bind(LessonsServiceErrorHandlerInterface::class, function () {
            /** @var LessonsServiceErrorHandler $facade */
            $facade = $this->app->make(LessonsServiceErrorHandler::class);
            $facade->setLessonModelValidator(new LessonModelValidator());
            return $facade;
        });
        $this->app->bind(LessonsServiceTransformersInterface::class, function () {
            /** @var LessonsServiceTransformers $facade */
            $facade = $this->app->make(LessonsServiceTransformers::class);
            $facade->setDateRequestModelTransformer(new DateRequestModelTransformer());
            $facade->setLessonTransformer(new LessonModelTransformer());
            $facade->setEvaluationRequestModelTransformer(new EvaluationRequestModelTransformer());
            return $facade;
        });

        $this->app->bind(StudentsServiceErrorHandlerInterface::class, function () {
            /** @var StudentsServiceErrorHandler $facade */
            $facade = $this->app->make(StudentsServiceErrorHandler::class);
            $facade->setUserModelValidator(new UserModelValidator());
            return $facade;
        });

        $this->app->bind(StudentsServiceTransformersInterface::class, function () {
            /** @var StudentsServiceTransformers $facade */
            $facade = $this->app->make(StudentsServiceTransformers::class);
            $facade->setUserTransformer(new UserModelTransformer());
            $facade->setUserRequestModelTransformer(new UserRequestModelTransformer());
            $facade->setUserLessonRequestModelTransformer(new UserLessonRequestModelTransformer());
            return $facade;
        });

        $this->app->bind(StudentsServiceRepositoriesInterface::class, StudentsServiceRepositories::class);

        $this->app->bind(EvaluationsServiceTransformersInterface::class, function () {
            /** @var EvaluationsServiceTransformers $facade */
            $facade = $this->app->make(EvaluationsServiceTransformers::class);
            $facade->setDateRequestModelTransformer(new DateRequestModelTransformer());
            return $facade;
        });

        $this->app->bind(EvaluationsServiceErrorHandlerInterface::class, EvaluationsServiceErrorHandler::class);

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

        $this->app->bind(StudentsServiceInterface::class, StudentsService::class);

        $this->app->bind(LessonsServiceInterface::class, LessonsService::class);

        $this->app->bind(EvaluationsServiceInterface::class, EvaluationsService::class);
    }
}
