<?php

declare(strict_types=1);

namespace App\Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;

final class UserModelValidator implements ValidatorInterface
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
            isset($data[DatabaseConstants::USERS_TABLE_ID]) === false ||
            isset($data[DatabaseConstants::USERS_TABLE_USERNAME]) === false ||
            isset($data[DatabaseConstants::USERS_TABLE_NAME]) === false ||
            isset($data[DatabaseConstants::USERS_TABLE_LAST_NAME]) === false ||
            isset($data[DatabaseConstants::USERS_TABLE_TYPE]) === false ||
            isset($data[DatabaseConstants::USERS_TABLE_EMAIL]) === false
        ) {
            throw new ValidatorException(__CLASS__);
        }
    }
}
