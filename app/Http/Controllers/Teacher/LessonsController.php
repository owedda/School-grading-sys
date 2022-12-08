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
        $lessons = $this->lessonsService->getAll();
        return view('lesson.index', compact('lessons'));
    }

    public function showUsers(DateRequest $request, string $lessonId): View
    {
        $dateRequestModel = $this->lessonsService
            ->getDateRequestModelTransformer()
            ->transformArrayToObject($request->all());

        $lesson = $this->lessonsService->getLesson($lessonId);
        $usersInConcreteLesson = $this->lessonsService->getUsersInConcreteLesson($lessonId, $dateRequestModel);

        return view(
            'lesson.users',
            compact('usersInConcreteLesson', 'lesson', 'dateRequestModel')
        );
    }

    public function storeUserEvaluation(EvaluationRequest $request): RedirectResponse
    {
        $evaluationRequestModel = $this->lessonsService
            ->getEvaluationRequestModelTransformer()
            ->transformArrayToObject($request->all());

        $this->lessonsService->storeEvaluation($evaluationRequestModel);

        return back();
    }

    public function destroyUserEvaluation(string $evaluationId): RedirectResponse
    {
        $this->lessonsService->destroyEvaluation($evaluationId);
        return back();
    }
}
