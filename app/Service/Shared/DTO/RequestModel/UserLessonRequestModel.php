<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\RequestModel;

final class UserLessonRequestModel
{
    public function __construct(
        private readonly string $userId,
        private readonly string $lessonId,
    ) {
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
