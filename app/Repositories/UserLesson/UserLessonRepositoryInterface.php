<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\StoreDTO\UserLessonStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonStoreDTO $requestDTO): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllByUserId(string $userId): DataCollection;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;
}
