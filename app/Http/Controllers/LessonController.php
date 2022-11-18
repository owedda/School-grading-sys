<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLessonRequest;
use App\Repositories\Lesson\LessonRepositoryInterface;

class LessonController extends Controller
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
    ) {
    }

    public function index()
    {

        $lessons = $this->lessonRepository->getAll();

        return view('lesson.index', compact('lessons'));
    }

    public function users(string $lessonId)
    {
        $lesson = $this->lessonRepository->getElementById($lessonId);

        $usersInConcreteLessonCollection = $this->lessonRepository->getUsersInConcreteLesson($lessonId);

        return view('lesson.users', compact('usersInConcreteLessonCollection', 'lesson'));
    }
}
