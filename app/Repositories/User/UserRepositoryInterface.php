<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\UserStoreDTO;

interface UserRepositoryInterface
{
    public function getAll(): DataCollection;

    public function storeStudent(UserStoreDTO $userRequestDTO): void;

    public function deleteById(string $id): void;

    public function getElementById(string $id);

    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection;
}
