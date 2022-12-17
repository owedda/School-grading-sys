<?php

namespace App\Service\Shared\Transformer;

use App\Service\Shared\Collection\DataCollection;

interface TransformerInterface extends TransformerToObjectInterface
{
    public function transformToCollection(array $data): DataCollection;
}
