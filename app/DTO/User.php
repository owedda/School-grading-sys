<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\UserType;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $name;
    private string $lastName;
    private UserType $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getType(): UserType
    {
        return $this->type;
    }

    public function setType(UserType $type): void
    {
        $this->type = $type;
    }
}
