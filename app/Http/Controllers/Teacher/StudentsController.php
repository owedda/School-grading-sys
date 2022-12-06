<?php

declare(strict_types=1);

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Student\StudentsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StudentsController extends Controller
{
    public function __construct(
        private readonly StudentsServiceInterface     $studentService,
        private readonly TransformerToObjectInterface $userTransformer
    ) {
    }

    public function index(): View
    {
        $users = $this->studentService->getAll();
        return view('students.index', compact('users'));
    }

    public function showLessons(string $userId): View
    {
        $user = $this->studentService->getStudent($userId);

        $usersAttendingLessonsCollection = $this->studentService->getStudentLessons($userId);

        return view('students.lessons', compact('usersAttendingLessonsCollection', 'user'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(UserStoreRequest $request): View
    {
        $studentInfo = $this->userTransformer->transformArrayToObject($request->all());

        $this->studentService->store($studentInfo);

        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->studentService->delete($userId);
        return back();
    }
}
