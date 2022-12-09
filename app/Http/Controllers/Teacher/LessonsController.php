<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Requests\EvaluationRequest;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LessonsController extends Controller
{
    public function __construct(
        private readonly LessonsServiceInterface $lessonsService,
    ) {
    }

    public function index(): View
    {
        $lessons = $this->lessonsService->getAllLessons();
        return view('lesson.index', compact('lessons'));
    }

    public function showUsers(DateRequest $request, string $lessonId): View
    {
        $date = $request->all();
        $usersResponseModel = $this->lessonsService->getUsersResponseModel($lessonId, $date);

        return view('lesson.users', compact('usersResponseModel'));
    }

    public function storeUserEvaluation(EvaluationRequest $request): RedirectResponse
    {
        $evaluation = $request->all();
        $this->lessonsService->storeEvaluation($evaluation);

        return back();
    }

    public function destroyUserEvaluation(string $evaluationId): RedirectResponse
    {
        $this->lessonsService->destroyEvaluation($evaluationId);
        return back();
    }
}
