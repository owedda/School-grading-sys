<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserType;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\DTO\UserStoreDTO;
use App\Service\Grading\Transformers\ModelToDataModel\UserTransformer;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly User $user,
        private readonly UserTransformer $transformer
    ) {
    }

    public function getAll(): DataCollection
    {
        $usersArray = $this->user->all()->toArray();
        return $this->transformer->transformArrayToCollection($usersArray);
    }

    public function storeStudent(UserStoreDTO $userRequestDTO): void
    {
        $newUser = new User();
        $newUser->username = $userRequestDTO->getUsername();
        $newUser->name = $userRequestDTO->getName();
        $newUser->last_name = $userRequestDTO->getLastName();
        $newUser->email = $userRequestDTO->getEmail();
        $newUser->password = $userRequestDTO->getPassword();
        $newUser->type = UserType::Student;
        $newUser->save();
    }

    public function deleteById(string $userId): void
    {
        $this->user->destroy($userId);
    }

    public function getElementById(string $userId): UserModel
    {
        return $this->transformer->transformToObject($this->user::find($userId));
    }
}
