<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return view('students.index', compact('users'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $this->userRepository->storeStudent($request);
        return view('students.create');
    }

    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $this->userRepository->deleteUser($user);
        return back();
    }
}
