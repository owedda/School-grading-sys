<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Students\Transformer\UserAttendedLessonResponseModelTransformerInterface;

final class StudentsServiceTransformers implements StudentsServiceTransformersInterface
{
    private TransformerToObjectInterface $userRequestModelTransformer;
    private TransformerToObjectInterface $userLessonRequestModelTransformer;
    private TransformerInterface $userTransformer;

    public function __construct(
        private readonly UserAttendedLessonResponseModelTransformerInterface $userAttendedLessonResponseModelTransformer
    ) {
    }

    public function getUserRequestModelTransformer(): TransformerToObjectInterface
    {
        return $this->userRequestModelTransformer;
    }

    public function setUserRequestModelTransformer(TransformerToObjectInterface $userRequestModelTransformer): void
    {
        $this->userRequestModelTransformer = $userRequestModelTransformer;
    }

    public function getUserLessonRequestModelTransformer(): TransformerToObjectInterface
    {
        return $this->userLessonRequestModelTransformer;
    }

    public function setUserLessonRequestModelTransformer(
        TransformerToObjectInterface $userLessonRequestModelTransformer
    ): void {
        $this->userLessonRequestModelTransformer = $userLessonRequestModelTransformer;
    }

    public function getUserTransformer(): TransformerInterface
    {
        return $this->userTransformer;
    }

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }

    public function getUserAttendedLessonResponseModelTransformer(): UserAttendedLessonResponseModelTransformerInterface
    {
        return $this->userAttendedLessonResponseModelTransformer;
    }
}
