<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Teacher\Students\DTO\ResponseModel\StudentLessonsResponseModel;
use App\Service\Teacher\Students\Transformers\UserAttendedLessonResponseModelTransformerInterface;

final class StudentsService implements StudentsServiceInterface
{
    private RequestModelTransformerInterface $userRequestModelTransformer;
    private RequestModelTransformerInterface $userLessonRequestModelTransformer;
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
        return $this->userTransformer->transformArrayToCollection($studentsArray);
    }

    public function getStudentLessons(string $userId): StudentLessonsResponseModel
    {
        $student = $this->getStudent($userId);
        $userAttendedLessonResponseModelCollection = $this->getUserAttendedLessonResponseModel($userId);
        return new StudentLessonsResponseModel($student, $userAttendedLessonResponseModelCollection);
    }

    public function store(array $user): void
    {
        $userRequestModel = $this->userRequestModelTransformer->transformArrayToObject($user);
        $this->userRepository->store($userRequestModel);
    }

    public function delete(string $userId): void
    {
        $this->userRepository->deleteById($userId);
    }

    public function storeUserLesson(array $userLesson): void
    {
        $userLessonRequestModel = $this->userLessonRequestModelTransformer->transformArrayToObject($userLesson);
        $this->userLessonRepository->save($userLessonRequestModel);
    }

    public function destroyUserLesson(string $userLessonId): void
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
    }

    private function getStudent(string $userId): UserModel
    {
        $userArray = $this->userRepository->getElementById($userId);
        return $this->userTransformer->transformArrayToObject($userArray);
    }

    private function getUserAttendedLessonResponseModel(string $userId): DataCollection
    {
        $userAttendedLessonsArray = $this->lessonRepository->getAllLessonsWithUserLessonsAttached($userId);
        return $this->userAttendedLessonResponseModelTransformer->transformArrayToCollection($userAttendedLessonsArray);
    }

    public function setUserLessonRequestModelTransformer(
        RequestModelTransformerInterface $userLessonRequestModelTransformer
    ): void {
        $this->userLessonRequestModelTransformer = $userLessonRequestModelTransformer;
    }

    public function setUserRequestModelTransformer(RequestModelTransformerInterface $userRequestModelTransformer): void
    {
        $this->userRequestModelTransformer = $userRequestModelTransformer;
    }

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }
}
