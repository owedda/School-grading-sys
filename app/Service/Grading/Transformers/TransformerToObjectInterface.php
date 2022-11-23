<?php

namespace App\Service\Grading\Transformers;

use App\Service\Grading\Exception\TransformerInvalidArgumentException;

interface TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data);
}
