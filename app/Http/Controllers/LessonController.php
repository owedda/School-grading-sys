<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Repositories\Lesson\LessonRepositoryInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(private readonly LessonRepositoryInterface $lessonRepository)
    {
    }

    public function index()
    {
        $lessons = $this->lessonRepository->getAllLessons();
        return view('lesson.index', compact('lessons'));
    }
}
