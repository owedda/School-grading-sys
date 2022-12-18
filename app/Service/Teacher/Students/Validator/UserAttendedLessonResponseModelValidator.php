<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\Validator;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;

final class UserAttendedLessonResponseModelValidator implements UserAttendedLessonResponseModelValidatorInterface
{
    private ValidatorInterface $lessonModelValidator;
    private ValidatorInterface $userLessonModelValidator;

    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void
    {
        foreach ($data as $item) {
            $this->lessonModelValidator->validateElement($item);
            if (isset($item[RelationshipConstants::LESSON_USERLESSON])) {
                $this->userLessonModelValidator->validateMany($item[RelationshipConstants::LESSON_USERLESSON]);
            }
        }
    }

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void
    {
        $this->lessonModelValidator = $lessonModelValidator;
    }

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void
    {
        $this->userLessonModelValidator = $userLessonModelValidator;
    }
}
