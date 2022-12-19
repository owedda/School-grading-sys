<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Facade\ErrorHandler;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidatorInterface;
use Psr\Log\LoggerInterface;

final class EvaluationsServiceErrorHandler implements EvaluationsServiceErrorHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly LessonEvaluationsValidatorInterface $lessonEvaluationsValidator
    ) {
    }

    public function handleLessonEvaluations(array $lessonEvaluations): void
    {
        try {
            $this->lessonEvaluationsValidator->validate($lessonEvaluations);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }
}
