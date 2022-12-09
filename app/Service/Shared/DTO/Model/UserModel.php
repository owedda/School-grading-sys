<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\Model;

final class UserModel
{
    public function __construct(
        private readonly string $id,
        private readonly string $username,
        private readonly string $email,
        private readonly string $name,
        private readonly string $lastName,
        private readonly string $type
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
