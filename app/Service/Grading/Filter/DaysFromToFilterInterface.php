<?php

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\CustomDTO\DateRangeDTO;

interface DaysFromToFilterInterface
{
    public function filter(DateRangeDTO $dateRange): DataCollection;
}
