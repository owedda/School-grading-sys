<?php

namespace App\Repositories\Lesson;

use App\Service\Grading\Collections\DataCollection;

interface LessonRepositoryInterface
{
    public function getAllLessons(): DataCollection;
}
