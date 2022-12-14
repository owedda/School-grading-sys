<?php

declare(strict_types=1);

namespace App\Service\Shared\DTO\RequestModel;

final class EvaluationRequestModel
{
    public function __construct(
        private readonly int $value,
        private readonly string $userLessonId,
        private readonly string $date
    ) {
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getUserLessonId(): string
    {
        return $this->userLessonId;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
