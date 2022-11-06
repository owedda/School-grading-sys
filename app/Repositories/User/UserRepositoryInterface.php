<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Collections\DataCollection;
use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll(): DataCollection;
    public function storeStudent(Request $request): void;
    public function deleteUser(User $user): void;
}
