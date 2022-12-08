<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Models\Lesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\ResponseModel\UserAttendedLessonResponseModelTransformerInterface;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\LessonModel;

final class LessonRepository implements LessonRepositoryInterface
{
    private TransformerInterface $lessonTransformer;

    public function __construct(
        private readonly Lesson $lesson,
        private readonly UserAttendedLessonResponseModelTransformerInterface $userAttendedLessonResponseModelTransformer
    ) {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection
    {
        return $this->lessonTransformer->transformArrayToCollection($this->lesson->all()->toArray());
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllLessonsWithUserLessonsAttached(string $userId): DataCollection
    {
        $arrayLessonsWithUserLessons = $this->lesson
            ::select()
            ->with(RelationshipConstants::LESSON_USERLESSON, function ($userLessons) use ($userId) {
                $userLessons->where(DatabaseConstants::USER_LESSONS_TABLE_USER_ID, $userId);
            })
            ->get()
            ->toArray();

        return $this->userAttendedLessonResponseModelTransformer
            ->transformArrayToCollection($arrayLessonsWithUserLessons);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): LessonModel
    {
        return $this->lessonTransformer->transformArrayToObject($this->lesson::findOrFail($id)->toArray());
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }
}
