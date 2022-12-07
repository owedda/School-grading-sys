<?php

declare(strict_types=1);

namespace App\Service\Grading\ValueObjects\ResponseModel;

use App\Service\Grading\Collections\DataCollection;
use DateTime;

final class MonthResponseModel
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
