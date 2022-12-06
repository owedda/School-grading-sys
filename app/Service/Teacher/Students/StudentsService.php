<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\StoreDTO\UserStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Filter\StudentAttendingLessonsFilterInterface;

final class StudentsService implements StudentsServiceInterface
{
    //TODO implement logger

    public function __construct(
        private readonly UserRepositoryInterface       $userRepository,
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly StudentAttendingLessonsFilterInterface $attendingLessonsFilter
    ) {
    }

    public function getAll(): DataCollection
    {
        return $this->userRepository->getAll();
    }

    public function getStudent(string $userId): UserModel
    {
        return $this->userRepository->getElementById($userId);
    }

    public function getStudentLessons(string $userId): DataCollection
    {
        $userLessons = $this->userLessonRepository->getAllByUserId($userId);
        $allLessons = $this->lessonRepository->getAll();

        return $this->attendingLessonsFilter->filter($allLessons, $userLessons);
    }

    public function store(UserStoreDTO $userRequestDTO): void
    {
        $this->userRepository->store($userRequestDTO);
    }

    public function delete(string $userId): void
    {
        $this->userRepository->deleteById($userId);
    }
}
