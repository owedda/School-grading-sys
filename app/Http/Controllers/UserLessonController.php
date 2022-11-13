<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserLesson;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserLessonController extends Controller
{
    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    //TODO: make own requests
    public function index(Request $request)
    {
        $userIdFromRequest = $request->input('user-id');
        $user = $this->userRepository->getElementById($userIdFromRequest);

        $userAttendingLessonsCollection = $this->userLessonRepository->getAllAttendingLessonsDTO($request);

        return view('userLessons.index', compact('userAttendingLessonsCollection', 'user'));
    }

    //TODO: make own requests
    public function store(Request $request): RedirectResponse
    {
        $this->userLessonRepository->save($request);

        return back();
    }

    public function destroy(string $userLessonId): RedirectResponse
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
        return back();
    }
}
