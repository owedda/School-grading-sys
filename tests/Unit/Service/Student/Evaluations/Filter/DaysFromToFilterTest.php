<?php

namespace Service\Student\Evaluations\Filter;

use App\Constants\DateConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;
use App\Service\Student\Evaluations\Filter\DaysFromToFilter;
use DateTime;
use PHPUnit\Framework\TestCase;

class DaysFromToFilterTest extends TestCase
{

    public function testFilterWhenCorrect()
    {
        $dateRange = new DateRange(new DateTime('2022-12-01'), new DateTime('2022-12-04'));
        $daysFromToFilter = new DaysFromToFilter();

        $expected = new DataCollection();
        $expected->add((new DateTime('2022-12-01'))->format(DateConstants::DAY_FORMAT));
        $expected->add((new DateTime('2022-12-02'))->format(DateConstants::DAY_FORMAT));
        $expected->add((new DateTime('2022-12-03'))->format(DateConstants::DAY_FORMAT));
        $expected->add((new DateTime('2022-12-04'))->format(DateConstants::DAY_FORMAT));

        $actual = $daysFromToFilter->filter($dateRange);

        $this->assertEquals($expected, $actual);
    }
}
