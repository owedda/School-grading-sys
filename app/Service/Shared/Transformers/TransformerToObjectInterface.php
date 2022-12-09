<?php

namespace App\Service\Shared\Transformers;

use App\Service\Shared\Exception\TransformerInvalidArgumentException;

interface TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): mixed;
}
