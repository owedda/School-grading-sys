<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateRequest;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use Illuminate\Contracts\View\View;

class LessonController extends Controller
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
    ) {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function index(): View
    {
        $lessons = $this->lessonRepository->getAll();
        return view('lesson.index', compact('lessons'));
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
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
