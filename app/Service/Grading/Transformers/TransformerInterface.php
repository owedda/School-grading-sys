<?php

namespace App\Service\Grading\Transformers;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;

interface TransformerInterface extends TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;
}
