<?php

namespace App\Http\Controllers;

use App\Repositories\Lesson\LessonRepositoryInterface;

class LessonController extends Controller
{
    public function __construct(private readonly LessonRepositoryInterface $lessonRepository)
    {
    }

    public function index()
    {
        $lessons = $this->lessonRepository->getAll();
        return view('lesson.index', compact('lessons'));
    }
}
