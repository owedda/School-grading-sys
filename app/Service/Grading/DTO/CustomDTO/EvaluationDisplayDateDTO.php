<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO\CustomDTO;

use App\Service\Grading\Collections\DataCollection;

final class EvaluationDisplayDateDTO
{
    public function __construct(
        private readonly string $month,
        private readonly DataCollection $daysCollection
    ) {
    }

    public function getMonth(): string
    {
        return $this->month;
    }

    public function getDaysCollection(): DataCollection
    {
        return $this->daysCollection;
    }
}
