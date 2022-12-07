<?php

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\ValueObjects\Custom\DateRange;

interface DaysFromToFilterInterface
{
    public function filter(DateRange $dateRange): DataCollection;
}
