<?php

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use DateTime;

interface DateFromToFilterInterface
{
    public function filter(DateTime $dateFrom, DateTime $dateTo): DataCollection;
}
