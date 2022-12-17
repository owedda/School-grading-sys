<?php

namespace App\Service\Shared\Validator\Model;

use App\Service\Shared\Exception\ValidatorException;

interface ValidatorInterface
{
    /**
     * @throws ValidatorException
     */
    public function validateMany(array $data): void;

    /**
     * @throws ValidatorException
     */
    public function validateElement(array $data): void;
}
