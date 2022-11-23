<?php

namespace App\Repositories\Student;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\UserStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

interface StudentRepositoryInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection;

    public function store(UserStoreDTO $userRequestDTO): void;

    public function deleteById(string $id): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): UserModel;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllLessonsAsAttendingLessonsDTOCollection(string $userID): DataCollection;

    public function setUserTransformer(TransformerInterface $userTransformer): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;
}
