<?php

namespace App\Service\Teacher\Students\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Students\Transformer\UserAttendedLessonResponseModelTransformerInterface;

interface StudentsServiceTransformersInterface
{
    public function getUserRequestModelTransformer(): TransformerToObjectInterface;

    public function setUserRequestModelTransformer(TransformerToObjectInterface $userRequestModelTransformer): void;

    public function getUserLessonRequestModelTransformer(): TransformerToObjectInterface;

    public function setUserLessonRequestModelTransformer(
        TransformerToObjectInterface $userLessonRequestModelTransformer
    ): void;

    public function getUserTransformer(): TransformerInterface;

    public function setUserTransformer(TransformerInterface $userTransformer): void;

    public function getUserAttendedLessonResponseModelTransformer(): UserAttendedLessonResponseModelTransformerInterface;
}
