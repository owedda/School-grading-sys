<?php

namespace App\Service\Student\Evaluations\Validator;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;

interface LessonEvaluationsValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void;

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void;

    public function setEvaluationModelValidator(ValidatorInterface $evaluationModelValidator): void;

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void;
}
