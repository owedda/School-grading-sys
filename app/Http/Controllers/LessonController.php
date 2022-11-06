<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
        return view('lesson.index', compact('lessons'));
    }

    public function create()
    {
        $users = Lesson::all();
        return view('lesson.create');
    }

    public function store(Request $request)
    {
        $lesson = Lesson::create($request->all());
        return redirect()->route('lesson.index');
    }

    public function show(Lesson $lesson)
    {
        return view('lesson.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        return view('lesson.edit', compact($lesson));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        return redirect()->route('lesson.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back();
    }
}
