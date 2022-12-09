<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\RequestModel;

use DateTime;

final class DateRequestModel
{
    public function __construct(private readonly DateTime $date)
    {
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
}
