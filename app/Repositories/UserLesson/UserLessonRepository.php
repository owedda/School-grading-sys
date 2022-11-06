<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Collections\DataCollection;
use App\DTO\UserLessonsDTO;
use App\Models\Lesson;
use App\Models\UserLesson;
use Illuminate\Http\Request;

class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(private readonly UserLesson $userLesson, private readonly Lesson $lesson)
    {
    }

    public function getAllLessonsCollectionWithAssignedStudentsOrNull(Request $request): DataCollection
    {
        $userId = $request->input('user_id');

        $collectionAllLessons = new DataCollection($this->lesson->all()->toArray());

        $userLessonsArray = $this->userLesson::where('user_id', $userId)->with('lessons')->get()->toArray();
        $collectionHaveLessons = new DataCollection($userLessonsArray);

        $collectionLessonsWithAssignedStudentsOrNull = new DataCollection();

        foreach ($collectionAllLessons as $value)
        {
            $this->addToLessonsCollection($collectionHaveLessons, $value, $collectionLessonsWithAssignedStudentsOrNull);
        }

        return $collectionLessonsWithAssignedStudentsOrNull;
    }

    private function addToLessonsCollection(DataCollection $collectionHaveLessons, $value, DataCollection $collectionLessonsWithAssignedStudentsOrNull): void
    {
        $item = $collectionHaveLessons->firstWhere('lesson_id', $value['id']);

        if (is_null($item) === false) {
            $collectionLessonsWithAssignedStudentsOrNull->add(new UserLessonsDTO($value['id'], $value['name'], true, $item['id']));
        } else {
            $collectionLessonsWithAssignedStudentsOrNull->add(new UserLessonsDTO($value['id'], $value['name'], false));
        }
    }
}
