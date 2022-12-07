<?php

declare(strict_types=1);

namespace App\Repositories\UserLesson;

use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

final class UserLessonRepository implements UserLessonRepositoryInterface
{
    private TransformerInterface $userLessonTransformer;

    public function __construct(
        private readonly UserLesson $userLesson,
    ) {
    }

    public function deleteElementById(string $id): void
    {
        $this->userLesson->destroy($id);
    }

    public function save(UserLessonRequestModel $requestModel): void
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $requestModel->getUserId();
        $userLesson->lesson_id = $requestModel->getLessonId();
        $userLesson->save();
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllByUserId(string $userId): DataCollection
    {
        $arrayUserLessons = $this->userLesson
            ::where('user_id', $userId)
            ->get()
            ->toArray();

        return $this->userLessonTransformer->transformArrayToCollection($arrayUserLessons);
    }

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void
    {
        $this->userLessonTransformer = $userLessonTransformer;
    }
}
