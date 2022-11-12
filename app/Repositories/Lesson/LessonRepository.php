<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Transformers\LessonTransformer;

final class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(private readonly Lesson $lesson, private readonly LessonTransformer $lessonTransformer)
    {
    }

    public function getAllLessons(): DataCollection
    {
        return $this->lessonTransformer->transformToCollection($this->lesson->all()->toArray());
    }
}
