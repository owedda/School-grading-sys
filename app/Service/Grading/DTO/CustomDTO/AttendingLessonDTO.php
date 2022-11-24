<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO\CustomDTO;

final class AttendingLessonDTO
{
    public function __construct(
        private readonly string $lessonId,
        private readonly string $lessonName,
        private readonly bool $isInLesson,
        private readonly ?string $userLessonId = null
    ) {
    }

    public function getLessonName(): string
    {
        return $this->lessonName;
    }

    public function isInLesson(): bool
    {
        return $this->isInLesson;
    }

    public function getLessonId(): string
    {
        return $this->lessonId;
    }

    public function getUserLessonId(): ?string
    {
        return $this->userLessonId;
    }
}
