<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLessonRequest;
use App\Http\Requests\UserLessonStoreRequest;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Transformers\ModelToDTO\UserLessonStoreDTOTransformer;
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
        $this->userLessonRepository->save($this->userLessonStoreDTOTransformer
            ->transformToObject($request->only('user-id', 'lesson-id')));

        return back();
    }

    public function destroy(string $userLessonId): RedirectResponse
    {
        $this->userLessonRepository->deleteElementById($userLessonId);
        return back();
    }
}
