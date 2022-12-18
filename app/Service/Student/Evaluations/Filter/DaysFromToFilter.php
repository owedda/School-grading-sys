<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Filter;

use App\Constants\DateConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;

final class DaysFromToFilter implements DaysFromToFilterInterface
{
    private const ADDEDTIME = '+1 day';

    public function filter(DateRange $dateRange): DataCollection
    {
        $collection = new DataCollection();

        for ($date = clone $dateRange->getDateFrom(); $date <= $dateRange->getDateTo(); $date->modify(self::ADDEDTIME)) {
            $collection->add($date->format(DateConstants::DAY_FORMAT));
        }

        return $collection;
    }
}
