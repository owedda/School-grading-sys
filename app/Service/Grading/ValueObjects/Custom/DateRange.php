<?php

declare(strict_types=1);

namespace App\Service\Grading\ValueObjects\Custom;

use DateTime;

final class DateRange
{
    public function __construct(
        private readonly DateTime $dateFrom,
        private readonly DateTime $dateTo
    ) {
    }

    public function getDateFrom(): DateTime
    {
        return $this->dateFrom;
    }

    public function getDateTo(): DateTime
    {
        return $this->dateTo;
    }
}
