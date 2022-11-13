<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Service\Grading\Transformers\ModelToDTO\UserStoreDTOTransformer;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserStoreDTOTransformer $userTransformer
    ) {
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
        $this->userRepository->storeStudent($this->userTransformer->transformToObject(
            $request->only('username', 'name', 'last-name', 'email', 'password')
        ));
        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->userRepository->deleteById($userId);
        return back();
    }
}
