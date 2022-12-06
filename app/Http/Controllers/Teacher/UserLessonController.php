<?php

declare(strict_types=1);

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLessonStoreRequest;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use Illuminate\Http\RedirectResponse;

class UserLessonController extends Controller
{
    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly TransformerToObjectInterface $userLessonStoreDTOTransformer
    ) {
    }

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
