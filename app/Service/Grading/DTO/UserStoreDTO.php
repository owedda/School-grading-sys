<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO;

class UserStoreDTO
{
    public function __construct(
        private readonly string $username,
        private readonly string $name,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return encrypt($this->password);
    }
}
