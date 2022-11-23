<?php

declare(strict_types=1);

namespace App\Service\Grading\Filter;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\DTO\AttendingLessonDTO;

final class StudentAttendingLessonsFilter
{
    public function filter(
        DataCollection $collectionAllLessons,
        DataCollection $collectionUserHaveLessons
    ): DataCollection {

        $collectionAttendingLessonDTO = new DataCollection();

        /** @var LessonModel $lesson */
        foreach ($collectionAllLessons as $lesson) {
            $collectionAttendingLessonDTO->add($this->getAttendingLessonDTO($collectionUserHaveLessons, $lesson));
        }

        return $collectionAttendingLessonDTO;
    }

    private function getAttendingLessonDTO(
        DataCollection $collectionUserHaveLessons,
        LessonModel $lesson
    ): AttendingLessonDTO {

        $item = $this->filterIfUserAttendsConcreteLessonElseNull($collectionUserHaveLessons, $lesson);

        if (is_null($item)) {
            return new AttendingLessonDTO($lesson->getId(), $lesson->getName(), false);
        }
        return new AttendingLessonDTO($lesson->getId(), $lesson->getName(), true, $item->getId());
    }

    private function filterIfUserAttendsConcreteLessonElseNull(
        DataCollection $collectionUserHaveLessons,
        LessonModel $lesson
    ): ?UserLessonModel {

        /** @var UserLessonModel $userLesson */
        foreach ($collectionUserHaveLessons as $key => $userLesson) {
            if ($userLesson->getLessonId() === $lesson->getId()) {
                return $userLesson;
            }
        }

        return null;
    }
}
