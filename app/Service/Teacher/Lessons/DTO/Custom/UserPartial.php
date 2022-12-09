<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\DTO\Custom;

final class UserPartial
{
    public function __construct(private readonly string $id, private readonly string $username)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
