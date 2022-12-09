<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Models\Lesson;

final class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(
        private readonly Lesson $lesson,
    ) {
    }

    public function getAll(): array
    {
        return $this->lesson->all()->toArray();
    }

    public function getAllLessonsWithUserLessonsAttached(string $userId): array
    {
        return $this->lesson
            ::select()
            ->with(RelationshipConstants::LESSON_USERLESSON, function ($userLessons) use ($userId) {
                $userLessons->where(DatabaseConstants::USER_LESSONS_TABLE_USER_ID, $userId);
            })
            ->get()
            ->toArray();
    }

    public function getElementById(string $id): array
    {
        return $this->lesson::findOrFail($id)->toArray();
    }
}
