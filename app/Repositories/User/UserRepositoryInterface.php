<?php

namespace App\Repositories\User;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\StoreDTO\UserStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

interface UserRepositoryInterface
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

    public function setUserTransformer(TransformerInterface $userTransformer): void;
}
