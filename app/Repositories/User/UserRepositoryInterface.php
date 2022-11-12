<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Service\Grading\Collections\DataCollection;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll(): DataCollection;

    public function storeStudent(Request $request): void;

    public function deleteById(string $userId): void;

    public function getElementById(string $userId);
}
