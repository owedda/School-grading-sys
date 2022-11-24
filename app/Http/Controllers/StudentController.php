<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StudentController extends Controller
{
    public function __construct(
        private readonly StudentRepositoryInterface $userRepository,
        private readonly TransformerToObjectInterface $userTransformer
    ) {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function index(): View
    {
        $users = $this->userRepository->getAll();
        return view('students.index', compact('users'));
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function showLessons(string $userId): View
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

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function store(UserStoreRequest $request): View
    {
        $this->userRepository
            ->store(
                $this->userTransformer
                ->transformArrayToObject($request->only('username', 'name', 'last-name', 'email', 'password'))
            );
        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->userRepository->deleteById($userId);
        return back();
    }
}
