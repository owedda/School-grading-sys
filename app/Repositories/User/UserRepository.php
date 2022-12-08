<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Constants\DatabaseConstants;
use App\Models\User;
use App\Models\UserTypeEnum;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserModel;
use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;
use Illuminate\Support\Facades\Hash;

final class UserRepository implements UserRepositoryInterface
{
    private TransformerInterface $userTransformer;

    public function __construct(private readonly User $user)
    {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllStudents(): DataCollection
    {
        $usersArray = $this->user
            ::where(DatabaseConstants::USERS_TABLE_TYPE, UserTypeEnum::Student->value)
            ->get()
            ->toArray();

        return $this->userTransformer->transformArrayToCollection($usersArray);
    }

    public function store(UserRequestModel $userRequestDTO): void
    {
        $newUser = new User();
        $newUser->username = $userRequestDTO->getUsername();
        $newUser->name = $userRequestDTO->getName();
        $newUser->last_name = $userRequestDTO->getLastName();
        $newUser->email = $userRequestDTO->getEmail();
        $newUser->password = Hash::make($userRequestDTO->getPassword());
        $newUser->type = UserTypeEnum::Student->value;
        $newUser->save();
    }

    public function deleteById(string $id): void
    {
        $this->user->destroy($id);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): UserModel
    {
        return $this->userTransformer->transformArrayToObject($this->user::findOrFail($id)->toArray());
    }

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }
}
