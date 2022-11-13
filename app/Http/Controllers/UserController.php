<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Service\Grading\DTO\UserRequestDTO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
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

    public function store(UserStoreRequest $request)
    {
        $this->userRepository->storeStudent($this->getUserRequestDTO($request));
        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->userRepository->deleteById($userId);
        return back();
    }

    private function getUserRequestDTO(UserStoreRequest $request): UserRequestDTO
    {
        $userRequestDTO = new UserRequestDTO();
        $userRequestDTO->setUsername($request->input('username'));
        $userRequestDTO->setName($request->input('name'));
        $userRequestDTO->setLastName($request->input('last-name'));
        $userRequestDTO->setEmail($request->input('email'));
        $userRequestDTO->setPassword($request->input('password'));
        return $userRequestDTO;
    }
}
