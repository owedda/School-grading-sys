<?php

namespace App\Service\Teacher\Students\Transformers;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Students\DTO\ResponseModel\UserAttendedLessonResponseModel;

interface UserAttendedLessonResponseModelTransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): UserAttendedLessonResponseModel;

    public function setLessonTransformerToObject(TransformerToObjectInterface $lessonTransformerToObject): void;

    public function setUserLessonTransformerToObject(TransformerToObjectInterface $userLessonTransformerToObject): void;
}
