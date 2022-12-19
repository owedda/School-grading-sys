<?php

namespace App\Service\Student\Evaluations\Facade\ErrorHandler;

use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidatorInterface;
use Psr\Log\LoggerInterface;

interface EvaluationsServiceErrorHandlerInterface
{
    public function handleLessonEvaluations(array $lessonEvaluations): void;
}
