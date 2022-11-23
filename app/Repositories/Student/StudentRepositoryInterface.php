<?php

declare(strict_types=1);

namespace App\Repositories\Student;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\UserStoreDTO;

interface StudentRepositoryInterface
{
    public function getAll(): DataCollection;

    public function store(UserStoreDTO $userRequestDTO): void;

    public function deleteById(string $id): void;

    public function getElementById(string $id): UserModel;

    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection;
}
