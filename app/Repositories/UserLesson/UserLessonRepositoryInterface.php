<?php

namespace App\Repositories\UserLesson;

use App\Collections\DataCollection;
use Illuminate\Http\Request;

interface UserLessonRepositoryInterface
{
    public function getAllLessonsCollectionWithAssignedStudentsOrNull(Request $request): DataCollection;
}
