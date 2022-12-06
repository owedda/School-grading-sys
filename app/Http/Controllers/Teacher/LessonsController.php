<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use Illuminate\Contracts\View\View;

class LessonsController extends Controller
{
    public function __construct(
        private readonly LessonsServiceInterface $lessonsService,
    ) {
    }

    public function index(): View
    {
        $lessons = $this->lessonsService->getAll();
        return view('lesson.index', compact('lessons'));
    }

    public function showUsers(DateRequest $request, string $lessonId): View
    {
        $date = $request->get('date');
        $lesson = $this->lessonsService->getLesson($lessonId);
        $usersInConcreteLessonCollection = $this->lessonsService->getUsersInConcreteLesson($lessonId, $date);

        return view(
            'lesson.users',
            compact('usersInConcreteLessonCollection', 'lesson', 'date')
        );
    }
}
