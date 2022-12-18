<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Validator;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;

final class StudentEvaluationsValidator implements StudentEvaluationsValidatorInterface
{
    private ValidatorInterface $userModelValidator;
    private ValidatorInterface $userLessonModelValidator;
    private ValidatorInterface $evaluationModelValidator;

    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void
    {
        foreach ($data as $item) {
            $this->userLessonModelValidator->validateElement($item);
            $this->userModelValidator->validateElement($item[RelationshipConstants::USERLESSON_USER]);
            if (isset($item[RelationshipConstants::USERLESSON_EVALUATIONS])) {
                $this->evaluationModelValidator->validateElement($item[RelationshipConstants::USERLESSON_EVALUATION]);
            }
        }
    }

    public function setUserModelValidator(ValidatorInterface $userModelValidator): void
    {
        $this->userModelValidator = $userModelValidator;
    }

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void
    {
        $this->userLessonModelValidator = $userLessonModelValidator;
    }

    public function setEvaluationModelValidator(ValidatorInterface $evaluationModelValidator): void
    {
        $this->evaluationModelValidator = $evaluationModelValidator;
    }
}
