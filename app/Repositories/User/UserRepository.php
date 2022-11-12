<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserType;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\Transformers\UserTransformer;
use Illuminate\Http\Request;

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
        return $this->transformer->transformToCollection($usersArray);
    }

    public function storeStudent(Request $request): void
    {
        $newUser = new User();
        $newUser->username = $request->input('username');
        $newUser->name = $request->input('name');
        $newUser->last_name = $request->input('last_name');
        $newUser->email = $request->input('email');
        $newUser->password = bcrypt($request->input('password'));
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
