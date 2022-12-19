<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Facade\ErrorHandler;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;
use Psr\Log\LoggerInterface;

final class LessonsServiceErrorHandler implements LessonsServiceErrorHandlerInterface
{
    private ValidatorInterface $lessonModelValidator;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly StudentEvaluationsValidatorInterface $studentEvaluationResponseModelValidator
    ) {
    }

    public function handleLessons(array $lessons): void
    {
        try {
            $this->lessonModelValidator->validateMany($lessons);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function handleLesson(array $lesson): void
    {
        try {
            $this->lessonModelValidator->validateElement($lesson);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function handleStudentsEvaluations(array $studentsEvaluations): void
    {
        try {
            $this->studentEvaluationResponseModelValidator->validate($studentsEvaluations);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void
    {
        $this->lessonModelValidator = $lessonModelValidator;
    }
}
