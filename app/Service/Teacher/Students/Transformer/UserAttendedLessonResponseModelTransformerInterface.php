<?php

namespace App\Service\Teacher\Students\Transformer;

use App\Service\Shared\Transformer\TransformerInterface;

interface UserAttendedLessonResponseModelTransformerInterface extends TransformerInterface
{
    public function setLessonTransformer(TransformerInterface $lessonTransformerToObject): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformerToObject): void;
}
