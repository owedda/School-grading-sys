<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Service\Grading\ValueObjects\ResponseModel\MonthResponseModel;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function __construct(private readonly EvaluationsServiceInterface $evaluationsService)
    {
    }

    public function index(DateRequest $dateRequest): View
    {
        $userId = Auth::id();
        $username = Auth::user()->username;

        $dateRequestModel = $this->evaluationsService
            ->getDateRequestModelTransformer()
            ->transformArrayToObject($dateRequest->all());

        $evaluations = $this->evaluationsService->getUserEvaluations($userId, $dateRequestModel);

        $month = $this->evaluationsService->getMonth($dateRequestModel);

        return view(
            'evaluations.index',
            compact(
                'evaluations',
                'month',
                'username'
            )
        );
    }
}
