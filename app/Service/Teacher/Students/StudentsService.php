<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Teacher\Students\DTO\ResponseModel\StudentLessonsResponseModel;
use App\Service\Teacher\Students\Facade\ErrorHandler\StudentsServiceErrorHandlerInterface;
use App\Service\Teacher\Students\Facade\Repositories\StudentsServiceRepositoriesInterface;
use App\Service\Teacher\Students\Facade\Transformers\StudentsServiceTransformersInterface;

final class StudentsService implements StudentsServiceInterface
{
    public function __construct(
        private readonly StudentsServiceErrorHandlerInterface $errorHandler,
        private readonly StudentsServiceTransformersInterface $transformers,
        private readonly StudentsServiceRepositoriesInterface $repositories
    ) {
    }

    public function getAll(): DataCollection
    {
        $studentsArray = $this->repositories->getUserRepository()->getAllStudents();

        $this->errorHandler->handleUsers($studentsArray);

        return $this->transformers->getUserTransformer()->transformToCollection($studentsArray);
    }

    public function getStudentLessons(string $userId): StudentLessonsResponseModel
    {
        $student = $this->getStudent($userId);
        $userAttendedLessonResponseModelCollection = $this->getUserAttendedLessonResponseModel($userId);
        return new StudentLessonsResponseModel($student, $userAttendedLessonResponseModelCollection);
    }

    public function store(array $user): void
    {
        $userRequestModel = $this->transformers->getUserRequestModelTransformer()->transformToObject($user);
        $this->repositories->getUserRepository()->store($userRequestModel);
    }

    public function delete(string $userId): void
    {
        $this->repositories->getUserRepository()->deleteById($userId);
    }

    public function storeUserLesson(array $userLesson): void
    {
        $userLessonRequestModel = $this->transformers
            ->getUserLessonRequestModelTransformer()
            ->transformToObject($userLesson);

        $this->repositories->getUserLessonRepository()->save($userLessonRequestModel);
    }

    public function destroyUserLesson(string $userLessonId): void
    {
        $this->repositories->getUserLessonRepository()->deleteElementById($userLessonId);
    }

    private function getStudent(string $userId): UserModel
    {
        $userArray = $this->repositories->getUserRepository()->getElementById($userId);

        $this->errorHandler->handleUser($userArray);

        return $this->transformers->getUserTransformer()->transformToObject($userArray);
    }

    private function getUserAttendedLessonResponseModel(string $userId): DataCollection
    {
        $userAttendedLessonsArray = $this->repositories
            ->getLessonRepository()
            ->getAllLessonsWithUserLessonsAttached($userId);

        $this->errorHandler->handleUserAttendedLessons($userAttendedLessonsArray);

        return $this->transformers
            ->getUserAttendedLessonResponseModelTransformer()
            ->transformToCollection($userAttendedLessonsArray);
    }
}
