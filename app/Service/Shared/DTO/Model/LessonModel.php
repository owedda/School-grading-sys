<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\Model;

final class LessonModel
{
    public function __construct(
        private readonly string $id,
        private readonly string $name
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
