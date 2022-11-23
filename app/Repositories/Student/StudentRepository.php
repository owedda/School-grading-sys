<?php

declare(strict_types=1);

namespace App\Repositories\Student;

use App\Models\Lesson;
use App\Models\User;
use App\Models\UserTypeEnum;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\UserStoreDTO;
use App\Service\Grading\Filter\StudentAttendingLessonsFilter;
use App\Service\Grading\Transformers\TransformerInterface;
use Illuminate\Support\Facades\Hash;

final class StudentRepository implements StudentRepositoryInterface
{
    private TransformerInterface $userTransformer;
    private TransformerInterface $userLessonTransformer;
    private TransformerInterface $lessonTransformer;

    public function __construct(
        private readonly User $user,
        private readonly Lesson $lesson,
        private readonly StudentAttendingLessonsFilter $studentAttendingLessonsFilter
    ) {
    }

    public function getAll(): DataCollection
    {
        $usersArray = $this->user->all()->toArray();
        return $this->userTransformer->transformArrayToCollection($usersArray);
    }

    public function store(UserStoreDTO $userRequestDTO): void
    {
        $newUser = new User();
        $newUser->username = $userRequestDTO->getUsername();
        $newUser->name = $userRequestDTO->getName();
        $newUser->last_name = $userRequestDTO->getLastName();
        $newUser->email = $userRequestDTO->getEmail();
        $newUser->password = Hash::make($userRequestDTO->getPassword());
        $newUser->type = UserTypeEnum::Student;
        $newUser->save();
    }

    public function deleteById(string $id): void
    {
        $this->user->destroy($id);
    }

    public function getElementById(string $id): UserModel
    {
        return $this->userTransformer->transformToObject($this->user::findOrFail($id)->toArray());
    }

    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection
    {
        $arrayUserWithUserLessons = $this->user
            ::where('id', $userID)
            ->with('userLessons')
            ->get()
            ->toArray();
        $arrayUserLessons = array_column($arrayUserWithUserLessons, 'user_lessons');

        $collectionUserHaveLessons = $this->userLessonTransformer->transformArrayToCollection($arrayUserLessons[0]);
        $collectionAllLessons = $this->lessonTransformer->transformArrayToCollection($this->lesson->all()->toArray());

        return $this->studentAttendingLessonsFilter->filter($collectionAllLessons, $collectionUserHaveLessons);
    }

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void
    {
        $this->userLessonTransformer = $userLessonTransformer;
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }
}
