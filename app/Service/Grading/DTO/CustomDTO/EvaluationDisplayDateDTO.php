<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO\CustomDTO;

use App\Service\Grading\Collections\DataCollection;
use DateTime;

final class EvaluationDisplayDateDTO
{
    public function __construct(
        private readonly DateTime $date,
        private readonly DataCollection $daysCollection
    ) {
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getDaysCollection(): DataCollection
    {
        return $this->daysCollection;
    }
}
