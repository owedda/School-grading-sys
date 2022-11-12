<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use Illuminate\Http\Request;

interface UserLessonRepositoryInterface
{
    public function getAllAttendingLessonsDTO(Request $request): DataCollection;

    public function deleteElementById(string $userLessonId): void;

    public function save(Request $request): void;
}
