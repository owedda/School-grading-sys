<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\Model;

final class UserLessonModel
{
    public function __construct(
        private readonly string $id,
        private readonly string $userId,
        private readonly string $lessonId
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getLessonId(): string
    {
        return $this->lessonId;
    }
}
