<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\DTO\ResponseModel;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Student\Evaluations\DTO\Custom\Month;

final class EvaluationsResponseModel
{
    public function __construct(
        private readonly DataCollection $evaluations,
        private readonly Month $month,
        private readonly string $username
    ) {
    }

    public function getEvaluations(): DataCollection
    {
        return $this->evaluations;
    }

    public function getMonth(): Month
    {
        return $this->month;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
