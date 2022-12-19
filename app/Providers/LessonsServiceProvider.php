<?php

namespace App\Providers;

use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserModelTransformer;
use App\Service\Shared\Transformer\RequestModel\DateRequestModelTransformer;
use App\Service\Shared\Transformer\RequestModel\EvaluationRequestModelTransformer;
use App\Service\Shared\Validator\Model\EvaluationModelValidator;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
use App\Service\Shared\Validator\Model\UserModelValidator;
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
use Illuminate\Support\ServiceProvider;

class LessonsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
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

        $this->app->bind(StudentEvaluationsTransformerInterface::class, function () {
            /** @var StudentEvaluationsTransformer $transformer */
            $transformer = $this->app->make(StudentEvaluationsTransformer::class);
            $transformer->setUserTransformer(new UserModelTransformer());
            $transformer->setEvaluationTransformer(new EvaluationModelTransformer(new EvaluationModelValidator()));
            $transformer->setUserLessonTransformer(new UserLessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(StudentEvaluationsValidatorInterface::class, function () {
            /** @var StudentEvaluationsValidator $validator */
            $validator = $this->app->make(StudentEvaluationsValidator::class);
            $validator->setEvaluationModelValidator(new EvaluationModelValidator());
            $validator->setUserModelValidator(new UserModelValidator());
            $validator->setUserLessonModelValidator(new UserLessonModelValidator());
            return $validator;
        });

        $this->app->bind(LessonsServiceInterface::class, LessonsService::class);
    }
}
