<?php

namespace App\Service\Student\Evaluations\Filter;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;

interface DaysFromToFilterInterface
{
    public function filter(DateRange $dateRange): DataCollection;
}
