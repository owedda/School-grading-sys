<?php

namespace App\Service\Teacher\Lessons\Validator;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;

interface StudentEvaluationsValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void;

    public function setUserModelValidator(ValidatorInterface $userModelValidator): void;

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void;

    public function setEvaluationModelValidator(ValidatorInterface $evaluationModelValidator): void;
}
