<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Constants\DatabaseConstants;
use App\Models\User;
use App\Models\UserTypeEnum;
use App\Service\Shared\DTO\RequestModel\UserRequestModel;
use Illuminate\Support\Facades\Hash;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $user)
    {
    }

    public function getAllStudents(): array
    {
        return $this->user
            ::where(DatabaseConstants::USERS_TABLE_TYPE, UserTypeEnum::Student->value)
            ->get()
            ->toArray();
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

    public function getElementById(string $id): array
    {
        return $this->user::findOrFail($id)->toArray();
    }
}
