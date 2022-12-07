<?php

namespace App\Service\Grading\Transformers\RequestModel;

use App\Service\Grading\Collections\DataCollection;

interface RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): mixed;
}
