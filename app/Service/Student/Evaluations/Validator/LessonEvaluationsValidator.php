<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Validator;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;

final class LessonEvaluationsValidator implements LessonEvaluationsValidatorInterface
{
    private ValidatorInterface $userLessonModelValidator;
    private ValidatorInterface $evaluationModelValidator;
    private ValidatorInterface $lessonModelValidator;

    /**
     * @throws ValidatorException
     */
    public function validate(array $data): void
    {
        foreach ($data as $item) {
            if (is_array($item[RelationshipConstants::USERLESSON_EVALUATIONS]) === false) {
                throw new ValidatorException();
            }

            $this->userLessonModelValidator->validateElement($item);
            $this->lessonModelValidator->validateElement($item[RelationshipConstants::USERLESSON_LESSON]);
            if (!empty($item[RelationshipConstants::USERLESSON_EVALUATIONS])) {
                $this->evaluationModelValidator->validateMany($item[RelationshipConstants::USERLESSON_EVALUATIONS]);
            }
        }
    }

    public function setUserLessonModelValidator(ValidatorInterface $userLessonModelValidator): void
    {
        $this->userLessonModelValidator = $userLessonModelValidator;
    }

    public function setEvaluationModelValidator(ValidatorInterface $evaluationModelValidator): void
    {
        $this->evaluationModelValidator = $evaluationModelValidator;
    }

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void
    {
        $this->lessonModelValidator = $lessonModelValidator;
    }
}
