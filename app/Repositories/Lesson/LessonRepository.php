<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Transformers\CustomToDTO\StudentEvaluationDTOTransformer;
use App\Service\Grading\Transformers\ModelToDataModel\LessonTransformer;
use App\Service\Grading\Transformers\ModelToDataModel\UserLessonTransformer;
use App\Service\Grading\Transformers\ModelToDataModel\UserTransformer;

final class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(
        private readonly Lesson $lesson,
        private readonly UserLesson $userLesson,
        private readonly LessonTransformer $lessonTransformer,
        private readonly StudentEvaluationDTOTransformer $studentEvaluationDTOTransformer,
        private readonly UserTransformer $userTransformer
    ) {
    }

    public function getAll(): DataCollection
    {
        return $this->lessonTransformer->transformArrayToCollection($this->lesson->all()->toArray());
    }

    public function getElementById(string $id): LessonModel
    {
        return $this->lessonTransformer->transformToObject($this->lesson::find($id));
    }

    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection
    {
        $arrayUserLessonsWithUsers = $this->userLesson::where('lesson_id', $lessonId)->with('user')->with('evaluation', function ($q) use ($date) {
            $q->where('date', $date);
        })->get()->toArray();

        return new DataCollection($this->studentEvaluationDTOTransformer->transformArrayToCollection($arrayUserLessonsWithUsers));
    }
}
