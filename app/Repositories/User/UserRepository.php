<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserLesson;
use App\Models\UserTypeEnum;
use App\Repositories\Lesson\LessonRepository;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\AttendingLessonDTO;
use App\Service\Grading\DTO\UserStoreDTO;
use App\Service\Grading\Transformers\ModelToDataModel\UserLessonTransformer;
use App\Service\Grading\Transformers\ModelToDataModel\UserTransformer;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly User $user,
        private readonly UserTransformer $transformer,
        private readonly UserLessonTransformer $userLessonTransformer,
        private readonly LessonRepository $lessonRepository
    ) {
    }

    public function getAll(): DataCollection
    {
        $usersArray = $this->user->all()->toArray();
        return $this->transformer->transformArrayToCollection($usersArray);
    }

    public function storeStudent(UserStoreDTO $userRequestDTO): void
    {
        $newUser = new User();
        $newUser->username = $userRequestDTO->getUsername();
        $newUser->name = $userRequestDTO->getName();
        $newUser->last_name = $userRequestDTO->getLastName();
        $newUser->email = $userRequestDTO->getEmail();
        $newUser->password = $userRequestDTO->getPassword();
        $newUser->type = UserTypeEnum::Student;
        $newUser->save();
    }

    public function deleteById(string $id): void
    {
        $this->user->destroy($id);
    }

    public function getElementById(string $id): UserModel
    {
        return $this->transformer->transformToObject($this->user::find($id));
    }


    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection
    {
        $arrayUserLessons = $this->user::where('id', $userID)->with('lessons')->get()->toArray();
        $arrayUserLessons = array_column($arrayUserLessons, 'lessons');


        //dd($arrayUserLessons);
        $collectionAttendingLessonDTO = new DataCollection();
        $collectionUserHaveLessons = $this->userLessonTransformer->transformArrayToCollection($arrayUserLessons[0]);
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
}
