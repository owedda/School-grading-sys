<?php

namespace App\Service\Shared\Transformer;

interface TransformerToObjectInterface
{
    public function transformToObject(array $data): mixed;
}
