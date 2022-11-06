<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Collections\DataCollection;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $user)
    {
    }

    public function getAll(): DataCollection
    {
        $users = $this->user->all()->toArray();
        return new DataCollection($users);
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

    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}
