<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Students\DTO\ResponseModel\StudentLessonsResponseModel;
use App\Service\Teacher\Students\Transformer\UserAttendedLessonResponseModelTransformerInterface;

final class StudentsService implements StudentsServiceInterface
{
    private TransformerToObjectInterface $userRequestModelTransformer;
    private TransformerToObjectInterface $userLessonRequestModelTransformer;
    private TransformerInterface $userTransformer;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly UserAttendedLessonResponseModelTransformerInterface $userAttendedLessonResponseModelTransformer
    ) {
    }

    public function getAll(): DataCollection
    {
        $studentsArray = $this->userRepository->getAllStudents();
        //TODO try catch
        return $this->userTransformer->transformToCollection($studentsArray);
    }

    public function getStudentLessons(string $userId): StudentLessonsResponseModel
    {
        $student = $this->getStudent($userId);
        $userAttendedLessonResponseModelCollection = $this->getUserAttendedLessonResponseModel($userId);
        return new StudentLessonsResponseModel($student, $userAttendedLessonResponseModelCollection);
    }

    public function store(array $user): void
    {
        $userRequestModel = $this->userRequestModelTransformer->transformToObject($user);
        $this->userRepository->store($userRequestModel);
    }

    public function delete(string $userId): void
    {
        $this->userRepository->deleteById($userId);
    }

    public function storeUserLesson(array $userLesson): void
    {
        $userLessonRequestModel = $this->userLessonRequestModelTransformer->transformToObject($userLesson);
        $this->userLessonRepository->save($userLessonRequestModel);
    }

    public function destroyUserLesson(string $userLessonId): void
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
    }

    private function getStudent(string $userId): UserModel
    {
        $userArray = $this->userRepository->getElementById($userId);
        //TODO try catch
        return $this->userTransformer->transformToObject($userArray);
    }

    private function getUserAttendedLessonResponseModel(string $userId): DataCollection
    {
        $userAttendedLessonsArray = $this->lessonRepository->getAllLessonsWithUserLessonsAttached($userId);
        //TODO try catch
        return $this->userAttendedLessonResponseModelTransformer->transformToCollection($userAttendedLessonsArray);
    }

    public function setUserLessonRequestModelTransformer(
        TransformerToObjectInterface $userLessonRequestModelTransformer
    ): void {
        $this->userLessonRequestModelTransformer = $userLessonRequestModelTransformer;
    }

    public function setUserRequestModelTransformer(TransformerToObjectInterface $userRequestModelTransformer): void
    {
        $this->userRequestModelTransformer = $userRequestModelTransformer;
    }

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }
}
