<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO\CustomDTO;

final class EvaluationDTO
{
    public function __construct(
        private readonly int $value,
        private readonly string $day,
    ) {
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getDay(): string
    {
        return $this->day;
    }
}
