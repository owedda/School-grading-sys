<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationStoreRequest;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Service\Grading\Transformers\RequestToDTO\EvaluationStoreDTOTransformer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct(
        private readonly EvaluationRepositoryInterface $evaluationRepository,
        private readonly EvaluationStoreDTOTransformer $evaluationStoreDTOTransformer
    ) {
    }

    public function store(EvaluationStoreRequest $request): RedirectResponse
    {
        $this->evaluationRepository->save($this->evaluationStoreDTOTransformer
            ->transformToObject($request->only('value', 'user-lesson-id', 'date')));

        return back();
    }

    public function destroy(string $evaluationId): RedirectResponse
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
        return back();
    }
}
