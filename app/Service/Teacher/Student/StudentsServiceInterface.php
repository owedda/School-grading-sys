<?php

namespace App\Service\Teacher\Student;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\StoreDTO\UserStoreDTO;

interface StudentsServiceInterface
{
    public function getAll(): DataCollection;

    public function getStudent(string $userId): UserModel;

    public function getStudentLessons(string $userId): DataCollection;

    public function store(UserStoreDTO $userRequestDTO): void;

    public function delete(string $userId): void;
}
