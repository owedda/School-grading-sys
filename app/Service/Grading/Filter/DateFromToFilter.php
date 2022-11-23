<?php

declare(strict_types=1);

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use DateTime;

final class DateFromToFilter
{
    public function filter(DateTime $dateFrom, DateTime $dateTo): DataCollection
    {
        $collection = new DataCollection();

        for ($date = clone $dateFrom; $date < $dateTo; $date->modify('+1 day')) {
            $collection->add($date->format('d'));
        }

        return $collection;
    }
}
