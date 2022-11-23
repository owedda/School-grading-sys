<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLessonStoreRequest;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Transformers\RequestToDTO\UserLessonStoreDTOTransformer;
use Illuminate\Http\RedirectResponse;

class UserLessonController extends Controller
{
    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly UserLessonStoreDTOTransformer $userLessonStoreDTOTransformer
    ) {
    }

    public function store(UserLessonStoreRequest $request): RedirectResponse
    {
        $this->userLessonRepository
            ->save(
                $this->userLessonStoreDTOTransformer
                ->transformToObject($request->only('user-id', 'lesson-id'))
            );

        return back();
    }

    public function destroy(string $userLessonId): RedirectResponse
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
        return back();
    }
}
