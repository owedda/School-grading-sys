<?php

namespace App\Service\Teacher\Lessons\Facade\ErrorHandler;

use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;

interface LessonsServiceErrorHandlerInterface
{
    public function handleLessons(array $lessons): void;

    public function handleLesson(array $lesson): void;

    public function handleStudentsEvaluations(array $studentsEvaluations): void;

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void;
}
