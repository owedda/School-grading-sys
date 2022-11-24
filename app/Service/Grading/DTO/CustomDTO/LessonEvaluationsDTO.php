<?php

declare(strict_types=1);

namespace App\Service\Grading\DTO\CustomDTO;

use App\Service\Grading\Collections\DataCollection;

final class LessonEvaluationsDTO
{
    public function __construct(
        private readonly string $lessonName,
        private readonly ?DataCollection $evaluations = null,
    ) {
    }

    public function getLessonName(): string
    {
        return $this->lessonName;
    }

    public function getEvaluations(): ?DataCollection
    {
        return $this->evaluations;
    }
}
