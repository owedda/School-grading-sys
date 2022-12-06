<?php

namespace App\Service\Teacher\Lessons;

use App\Service\Grading\Collections\DataCollection;

interface LessonsServiceInterface
{
    public function getAll(): DataCollection;

    public function getLesson(string $id);

    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection;
}
