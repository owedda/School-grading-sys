<?php

namespace App\Service\Teacher\Students\Validator;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;

interface UserAttendedLessonResponseModelValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void;

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void;

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void;
}
