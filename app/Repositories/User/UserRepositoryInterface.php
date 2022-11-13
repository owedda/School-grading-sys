<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\UserRequestDTO;

interface UserRepositoryInterface
{
    public function getAll(): DataCollection;

    public function storeStudent(UserRequestDTO $userRequestDTO): void;

    public function deleteById(string $userId): void;

    public function getElementById(string $userId);
}
