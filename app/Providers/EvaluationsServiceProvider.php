<?php

namespace App\Providers;

use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformer\RequestModel\DateRequestModelTransformer;
use App\Service\Shared\Validator\Model\EvaluationModelValidator;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
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
use Illuminate\Support\ServiceProvider;

class EvaluationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(DaysFromToFilterInterface::class, DaysFromToFilter::class);

        $this->app->bind(LessonEvaluationsTransformerInterface::class, function () {
            /** @var LessonEvaluationsTransformer $transformer */
            $transformer = $this->app->make(LessonEvaluationsTransformer::class);
            $transformer->setEvaluationTransformer(new EvaluationModelTransformer(new EvaluationModelValidator()));
            $transformer->setUserLessonTransformer(new UserLessonModelTransformer());
            $transformer->setLessonTransformer(new LessonModelTransformer());
            return $transformer;
        });

        $this->app->bind(LessonEvaluationsValidatorInterface::class, function () {
            /** @var LessonEvaluationsValidator $validator */
            $validator = $this->app->make(LessonEvaluationsValidator::class);
            $validator->setEvaluationModelValidator(new EvaluationModelValidator());
            $validator->setLessonModelValidator(new LessonModelValidator());
            $validator->setUserLessonModelValidator(new UserLessonModelValidator());
            return $validator;
        });

        $this->app->bind(EvaluationsServiceTransformersInterface::class, function () {
            /** @var EvaluationsServiceTransformers $facade */
            $facade = $this->app->make(EvaluationsServiceTransformers::class);
            $facade->setDateRequestModelTransformer(new DateRequestModelTransformer());
            return $facade;
        });

        $this->app->bind(EvaluationsServiceErrorHandlerInterface::class, EvaluationsServiceErrorHandler::class);
        $this->app->bind(EvaluationsServiceInterface::class, EvaluationsService::class);
    }
}
