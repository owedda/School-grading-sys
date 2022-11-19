<?php

namespace App\Service\Grading\Transformers;

use App\Service\Grading\Collections\DataCollection;

interface TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection;
}
