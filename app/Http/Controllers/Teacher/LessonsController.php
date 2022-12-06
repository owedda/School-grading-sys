<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Repositories\Lesson\LessonRepositoryInterface;
use Illuminate\Contracts\View\View;

class LessonsController extends Controller
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
    ) {
    }

    public function index(): View
    {
        $lessons = $this->lessonRepository->getAll();
        return view('lesson.index', compact('lessons'));
    }

    public function showUsers(DateRequest $request, string $lessonId): View
    {
        $date = $request->get('date');
        $lesson = $this->lessonRepository->getElementById($lessonId);
        $usersInConcreteLessonCollection = $this->lessonRepository->getUsersInConcreteLesson($lessonId, $date);

        return view(
            'lesson.users',
            compact('usersInConcreteLessonCollection', 'lesson', 'date')
        );
    }
}
