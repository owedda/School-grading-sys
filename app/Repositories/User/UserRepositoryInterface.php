<?php

namespace App\Repositories\User;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserModel;
use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;

interface UserRepositoryInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection;

    public function store(UserRequestModel $userRequestDTO): void;

    public function deleteById(string $id): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): UserModel;

    public function setUserTransformer(TransformerInterface $userTransformer): void;
}
