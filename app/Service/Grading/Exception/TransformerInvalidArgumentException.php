<?php

declare(strict_types=1);

namespace App\Service\Grading\Exception;

use Doctrine\DBAL\Exception;
use Throwable;

final class TransformerInvalidArgumentException extends Exception
{
    public function __construct(string $className = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(sprintf('%s calling with incorrect array argument', $className), $code, $previous);
    }
}
