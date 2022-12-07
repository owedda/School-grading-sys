<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserModel;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;
use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;

final class StudentsService implements StudentsServiceInterface
{
    private RequestModelTransformerInterface $userRequestModelTransformer;
    private RequestModelTransformerInterface $userLessonRequestModelTransformer;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository
    ) {
    }

    public function getAll(): DataCollection
    {
        return $this->userRepository->getAllStudents();
    }

    public function getStudent(string $userId): UserModel
    {
        return $this->userRepository->getElementById($userId);
    }

    public function getStudentLessons(string $userId): DataCollection
    {
        return $this->lessonRepository->getAllLessonsWithUserLessonsAttached($userId);
    }

    public function store(UserRequestModel $userRequestDTO): void
    {
        $this->userRepository->store($userRequestDTO);
    }

    public function delete(string $userId): void
    {
        $this->userRepository->deleteById($userId);
    }

    public function storeUserLesson(UserLessonRequestModel $userLessonRequestModel): void
    {
        $this->userLessonRepository->save($userLessonRequestModel);
    }

    public function destroyUserLesson(string $userLessonId): void
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
    }

    public function setUserLessonRequestModelTransformer(
        RequestModelTransformerInterface $userLessonRequestModelTransformer
    ): void {
        $this->userLessonRequestModelTransformer = $userLessonRequestModelTransformer;
    }

    public function getUserLessonRequestModelTransformer(): RequestModelTransformerInterface
    {
        return $this->userLessonRequestModelTransformer;
    }

    public function getUserRequestModelTransformer(): RequestModelTransformerInterface
    {
        return $this->userRequestModelTransformer;
    }

    public function setUserRequestModelTransformer(RequestModelTransformerInterface $userRequestModelTransformer): void
    {
        $this->userRequestModelTransformer = $userRequestModelTransformer;
    }
}
