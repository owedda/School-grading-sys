<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Collections\DataCollection;
use App\Models\Lesson;

class LessonRepository
{
    public function __construct(private readonly Lesson $lesson)
    {
    }

    public function getAllLessons(): DataCollection
    {
        return new DataCollection($this->lesson->all()->toArray());
    }
}
