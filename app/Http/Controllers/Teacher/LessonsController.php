<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Requests\EvaluationStoreRequest;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Teacher\Lessons\LessonsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LessonsController extends Controller
{
    public function __construct(
        private readonly LessonsServiceInterface $lessonsService,
        private readonly RequestModelTransformerInterface $evaluationRequestModelTransformer
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
        $usersInConcreteLesson = $this->lessonsService->getUsersInConcreteLesson($lessonId, $date);

        return view(
            'lesson.users',
            compact('usersInConcreteLesson', 'lesson', 'date')
        );
    }

    public function storeUserEvaluation(EvaluationStoreRequest $request): RedirectResponse
    {
        $evaluationStoreRequestModel =
            $this->evaluationRequestModelTransformer
            ->transformArrayToObject($request->all());

        $this->lessonsService->storeEvaluation($evaluationStoreRequestModel);

        return back();
    }

    public function destroyUserEvaluation(string $evaluationId): RedirectResponse
    {
        $this->lessonsService->destroyEvaluation($evaluationId);
        return back();
    }
}