<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\UserLesson;
use App\Repositories\Lesson\LessonRepository;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\DTO\AttendingLessonDTO;
use App\Service\Grading\DTO\UserLessonStoreDTO;
use App\Service\Grading\Transformers\ModelToDataModel\UserLessonTransformer;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(
        private readonly UserLesson $userLesson,
        private readonly UserLessonTransformer $userLessonTransformer,
        private readonly LessonRepository $lessonRepository
    ) {
    }

    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection
    {
        $arrayUserLessons = $this->userLesson::where('user_id', $userID)->with('lessons')->get()->toArray();

        $collectionAttendingLessonDTO = new DataCollection();
        $collectionUserHaveLessons = $this->userLessonTransformer->transformArrayToCollection($arrayUserLessons);
        $collectionAllLessons = $this->lessonRepository->getAll();

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

        foreach ($collectionUserHaveLessons as $key => $userLesson) {
            if ($userLesson->getLessonId() === $lesson->getId()) {
                return $userLesson;
            }
        }

        return null;
    }

    public function deleteElementById(string $userLessonId): void
    {
        $this->userLesson->destroy($userLessonId);
    }

    public function save(UserLessonStoreDTO $requestDTO): void
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $requestDTO->getUserId();
        $userLesson->lesson_id = $requestDTO->getLessonId();
        $userLesson->save();
    }

    public function getUsersInConcreteLesson(string $lessonId): DataCollection
    {
        $collectionUsersInConcreteLesson = new DataCollection();



        return $collectionUsersInConcreteLesson;
    }
}
