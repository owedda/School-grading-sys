<?php

namespace App\Service\Shared\Transformers\RequestModel;

interface RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): mixed;
}
