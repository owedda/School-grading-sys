<?php

declare(strict_types=1);

namespace App\Service\Grading\ValueObjects\Model;

use DateTime;

final class EvaluationModel
{
    //TODO $day turi buti ne string
    public function __construct(
        private readonly string $id,
        private readonly int $value,
        private readonly DateTime $date,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
}
