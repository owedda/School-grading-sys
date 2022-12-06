<?php

declare(strict_types=1);

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\CustomDTO\DateRangeDTO;

final class DaysFromToFilter implements DaysFromToFilterInterface
{
    private const DAYFORMAT = 'd';
    private const ADDEDTIME = '+1 day';

    public function filter(DateRangeDTO $dateRange): DataCollection
    {
        $collection = new DataCollection();

        for ($date = clone $dateRange->getDateFrom(); $date < $dateRange->getDateTo(); $date->modify(self::ADDEDTIME)) {
            $collection->add($date->format(self::DAYFORMAT));
        }

        return $collection;
    }
}
