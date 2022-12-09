<?php

declare(strict_types=1);

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLessonRequest;
use App\Http\Requests\UserRequest;
use App\Service\Teacher\Students\StudentsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StudentsController extends Controller
{
    public function __construct(
        private readonly StudentsServiceInterface $studentService
    ) {
    }

    public function index(): View
    {
        $students = $this->studentService->getAll();
        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(UserRequest $request): View
    {
        $studentInfo = $request->all();

        $this->studentService->store($studentInfo);
        return view('students.create');
    }

    public function destroy(string $userId): RedirectResponse
    {
        $this->studentService->delete($userId);
        return back();
    }

    public function showLessons(string $userId): View
    {
        $studentLessons = $this->studentService->getStudentLessons($userId);
        return view('students.lessons', compact('studentLessons'));
    }

    public function storeUserLesson(UserLessonRequest $request): RedirectResponse
    {
        $userLessonArray = $request->all();
        $this->studentService->storeUserLesson($userLessonArray);

        return back();
    }

    public function destroyUserLesson(string $userLessonId): RedirectResponse
    {
        $this->studentService->destroyUserLesson($userLessonId);
        return back();
    }
}
