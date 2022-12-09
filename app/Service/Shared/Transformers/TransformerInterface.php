<?php

namespace App\Service\Shared\Transformers;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;

interface TransformerInterface extends TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;
}
