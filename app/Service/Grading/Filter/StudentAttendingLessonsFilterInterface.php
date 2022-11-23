<?php

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;

interface StudentAttendingLessonsFilterInterface
{
    public function filter(
        DataCollection $collectionAllLessons,
        DataCollection $collectionUserHaveLessons
    ): DataCollection;
}
