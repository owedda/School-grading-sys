<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Requests\EvaluationStoreRequest;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Service\Grading\DTO\CustomDTO\DateRangeDTO;
use App\Service\Grading\DTO\CustomDTO\EvaluationDisplayDateDTO;
use App\Service\Grading\Filter\DaysFromToFilterInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function __construct(
        private readonly EvaluationRepositoryInterface $evaluationRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly DaysFromToFilterInterface $daysFromToFilter
    ) {
    }

    public function index(DateRequest $dateRequest): View
    {
        $userId = Auth::id();
        $date = new DateTime($dateRequest->get('date'));

        $dateMonthRange = new DateRangeDTO(
            new DateTime('first day of ' . $date->format('Y-m-d')),
            new DateTime('last day of ' . $date->format('Y-m-d'))
        );

        $user = $this->userRepository->getElementById($userId);

        $lessonsEvaluations = $this->evaluationRepository->getUserEvaluations($userId, $dateMonthRange);
        $dateFromToCollection = $this->daysFromToFilter->filter($dateMonthRange);

        $evaluationDisplayDate = new EvaluationDisplayDateDTO(
            $date,
            $dateFromToCollection
        );

        return view(
            'evaluations.index',
            compact(
                'lessonsEvaluations',
                'evaluationDisplayDate',
                'user'
            )
        );
    }
}
