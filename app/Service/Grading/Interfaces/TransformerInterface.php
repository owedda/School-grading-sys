<?php

namespace App\Service\Grading\Interfaces;

use App\Service\Grading\Collections\DataCollection;

interface TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection;
}
