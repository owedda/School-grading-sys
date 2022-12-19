<?php

namespace App\Providers;

use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserModelTransformer;
use App\Service\Shared\Transformer\RequestModel\UserLessonRequestModelTransformer;
use App\Service\Shared\Transformer\RequestModel\UserRequestModelTransformer;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
use App\Service\Shared\Validator\Model\UserModelValidator;
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

class StudentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
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

        $this->app->bind(StudentsServiceInterface::class, StudentsService::class);
    }
}
