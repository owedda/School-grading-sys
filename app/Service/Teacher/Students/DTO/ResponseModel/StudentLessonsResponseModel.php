<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\DTO\ResponseModel;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;

final class StudentLessonsResponseModel
{
    public function __construct(
        private readonly UserModel $user,
        private readonly DataCollection $lessons
    ) {
    }

    public function getUser(): UserModel
    {
        return $this->user;
    }

    public function getLessons(): DataCollection
    {
        return $this->lessons;
    }
}
