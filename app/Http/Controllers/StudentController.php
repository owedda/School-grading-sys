<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Service\Grading\Transformers\RequestToDTO\UserStoreDTOTransformer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StudentController extends Controller
{
    public function __construct(
        private readonly StudentRepositoryInterface $userRepository,
        private readonly UserStoreDTOTransformer $userTransformer
    ) {
    }

    public function index(): View
    {
        $users = $this->userRepository->getAll();
        return view('students.index', compact('users'));
    }

    public function lessons(string $userId): View
    {
        $user = $this->userRepository->getElementById($userId);

        $usersAttendingLessonsCollection = $this->userRepository
            ->getAllLessonsAsAttendingLessonsDTOCollection($userId);

        return view('students.lessons', compact('usersAttendingLessonsCollection', 'user'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(UserStoreRequest $request): View
    {
        $this->userRepository
            ->store(
                $this->userTransformer
                ->transformToObject($request->only('username', 'name', 'last-name', 'email', 'password'))
            );
        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->userRepository->deleteById($userId);
        return back();
    }
}
