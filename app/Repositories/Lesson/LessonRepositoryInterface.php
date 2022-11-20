<?php

namespace App\Repositories\Lesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;

interface LessonRepositoryInterface
{
    public function getAll(): DataCollection;

    public function getElementById(string $id): LessonModel;

    public function getUsersInConcreteLesson(string $lessonId, string $date);
}
