<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO;

final class StudentEvaluationDTO
{
    public function __construct(
        private readonly string $username,
        private readonly string $name,
        private readonly string $lastName,
        private readonly string $userLessonId,
        private readonly ?string $evaluationId = null,
        private readonly ?int $evaluationValue = null,
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

    public function getUserLessonId(): string
    {
        return $this->userLessonId;
    }

    public function getEvaluationValue(): ?int
    {
        return $this->evaluationValue;
    }

    public function getEvaluationId(): ?string
    {
        return $this->evaluationId;
    }
}
