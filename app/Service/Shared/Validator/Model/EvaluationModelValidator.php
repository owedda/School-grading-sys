<?php

declare(strict_types=1);

namespace App\Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;

final class EvaluationModelValidator implements ValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validateMany(array $data): void
    {
        foreach ($data as $element) {
            if (is_array($element) === false) {
                throw new ValidatorException(__CLASS__);
            }
            $this->validateElement($element);
        }
    }

    /**
     * @throws ValidatorException
     */
    public function validateElement(array $data): void
    {
        if (
            isset($data[DatabaseConstants::EVALUATIONS_TABLE_ID]) === false ||
            isset($data[DatabaseConstants::EVALUATIONS_TABLE_VALUE]) === false ||
            isset($data[DatabaseConstants::EVALUATIONS_TABLE_DATE]) === false
        ) {
            throw new ValidatorException(__CLASS__);
        }
    }
}
