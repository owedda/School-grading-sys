<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\Lesson;
use App\Models\UserLesson;
use App\Repositories\Lesson\LessonRepository;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\DTO\AttendingLessonDTO;
use App\Service\Grading\Interfaces\TransformerInterface;
use App\Service\Grading\Transformers\LessonTransformer;
use App\Service\Grading\Transformers\UserLessonTransformer;
use Illuminate\Http\Request;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    public function __construct(
        private readonly UserLesson $userLesson,
        private readonly UserLessonTransformer $userLessontransformer,
        private readonly LessonRepository $lessonRepository
    ) {
    }

    public function getAllAttendingLessonsDTO(Request $request): DataCollection
    {
        $userIdFromRequest = $request->input('user-id');
        $arrayUserLessons = $this->userLesson::where('user_id', $userIdFromRequest)->with('lessons')->get()->toArray();

        $collectionAttendingLessonDTO = new DataCollection();
        $collectionUserHaveLessons = $this->userLessontransformer->transformToCollection($arrayUserLessons);
        $collectionAllLessons = $this->lessonRepository->getAllLessons();

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

    public function save(Request $request): void
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $request->input('user-id');
        $userLesson->lesson_id = $request->input('$lesson-id');
        $userLesson->save();
    }
}
