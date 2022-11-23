<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLessonStoreRequest;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use Illuminate\Http\RedirectResponse;

class UserLessonController extends Controller
{
    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly TransformerToObjectInterface $userLessonStoreDTOTransformer
    ) {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function store(UserLessonStoreRequest $request): RedirectResponse
    {
        $this->userLessonRepository
            ->save(
                $this->userLessonStoreDTOTransformer
                ->transformArrayToObject($request->only('user-id', 'lesson-id'))
            );

        return back();
    }

    public function destroy(string $userLessonId): RedirectResponse
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
        return back();
    }
}
