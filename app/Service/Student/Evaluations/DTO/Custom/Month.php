<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\DTO\Custom;

use App\Service\Shared\Collection\DataCollection;
use DateTime;

final class Month
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
