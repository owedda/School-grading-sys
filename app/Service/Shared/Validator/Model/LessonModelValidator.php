<?php

declare(strict_types=1);

namespace App\Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;

final class LessonModelValidator implements ValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validateMany(array $data): void
    {
        foreach ($data as $element) {
            $this->validateElement($element);
        }
    }

    /**
     * @throws ValidatorException
     */
    public function validateElement(array $data): void
    {
        if (
            isset($data[DatabaseConstants::LESSONS_TABLE_ID]) === false ||
            isset($data[DatabaseConstants::LESSONS_TABLE_NAME]) === false
        ) {
            throw new ValidatorException(__CLASS__);
        }
    }
}
