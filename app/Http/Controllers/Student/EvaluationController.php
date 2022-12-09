<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Service\Student\Evaluations\EvaluationsServiceInterface;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function __construct(private readonly EvaluationsServiceInterface $evaluationsService)
    {
    }

    public function index(DateRequest $dateRequest): View
    {
        $user = new UserPartial(Auth::id(), Auth::user()->username);
        $date = $dateRequest->all();
        $evaluationsResponseModel = $this->evaluationsService->getEvaluationsResponseModel($user, $date);

        return view('evaluations.index', compact('evaluationsResponseModel'));
    }
}
