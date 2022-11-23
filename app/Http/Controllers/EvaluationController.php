<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationStoreRequest;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Service\Grading\DTO\EvaluationDisplayDateDTO;
use App\Service\Grading\Filter\DateFromToFilter;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EvaluationController extends Controller
{
    public function __construct(
        private readonly EvaluationRepositoryInterface $evaluationRepository,
        private readonly StudentRepositoryInterface $userRepository,
        private readonly TransformerToObjectInterface $evaluationStoreDTOTransformer
    ) {
    }

    public function index(): View
    {
        $userId = '07f91c86-4b39-3f8d-ac53-4a0160168e33';
        $month = new DateTime('this month');
        $dateFrom = new DateTime('first day of this month');
        $dateTo = new DateTime('last day of this month');
        $user = $this->userRepository->getElementById($userId);

        $daysCollection = new DateFromToFilter();

        $lessonsEvaluations = $this->evaluationRepository->getUserEvaluations($userId, $dateFrom, $dateTo);

        $evaluationDisplayDate = new EvaluationDisplayDateDTO(
            $month->format('Y-m'),
            $daysCollection->filter($dateFrom, $dateTo)
        );

        return view(
            'evaluations.index',
            compact('lessonsEvaluations', 'evaluationDisplayDate', 'user')
        );
    }

    public function store(EvaluationStoreRequest $request): RedirectResponse
    {
        $this->evaluationRepository
            ->save(
                $this->evaluationStoreDTOTransformer
                ->transformToObject($request->only('value', 'user-lesson-id', 'date'))
            );

        return back();
    }

    public function destroy(string $evaluationId): RedirectResponse
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
        return back();
    }
}
