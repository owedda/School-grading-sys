<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\DTO\UserLessonRequestDTO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserLessonController extends Controller
{
    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly LessonRepositoryInterface $lessonRepository,
    ) {
    }

    //TODO: make own requests
    public function index(Request $request)
    {
        $userIdFromRequest = $request->input('user-id');
        $user = $this->userRepository->getElementById($userIdFromRequest);

        $usersAttendingLessonsCollection = $this->userLessonRepository
            ->getAllLessonsAsAttendingLessonsDTOCollection($userIdFromRequest);

        return view('userLessons.index', compact('usersAttendingLessonsCollection', 'user'));
    }

    public function usersInConcreteLesson(Request $request)
    {
        $lessonIdFromRequest = $request->input('lesson-id');
        $lesson = $this->lessonRepository->getElementById($lessonIdFromRequest);

        $usersInConcreteLessonCollection = $this->userLessonRepository->getUsersInConcreteLesson($lessonIdFromRequest);

        return view('userLessons.index', compact('usersInConcreteLessonCollection', 'lesson'));
    }

    //TODO: make own requests
    public function store(Request $request): RedirectResponse
    {
        $userLesson = new UserLessonRequestDTO(
            $request->input('user-id'),
            $request->input('lesson-id')
        );
        $this->userLessonRepository->save($userLesson);

        return back();
    }

    public function destroy(string $userLessonId): RedirectResponse
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
        return back();
    }
}
