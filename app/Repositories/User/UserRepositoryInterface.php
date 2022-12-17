<?php

namespace App\Repositories\User;

use App\Service\Shared\DTO\RequestModel\UserRequestModel;
use App\Service\Shared\Transformer\TransformerInterface;

interface UserRepositoryInterface
{
    public function getAllStudents(): array;

    public function store(UserRequestModel $userRequestDTO): void;

    public function deleteById(string $id): void;

    public function getElementById(string $id): array;
}
