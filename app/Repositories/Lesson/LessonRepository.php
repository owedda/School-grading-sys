<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Transformers\ModelToDataModel\LessonTransformer;

final class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(private readonly Lesson $lesson, private readonly LessonTransformer $lessonTransformer)
    {
    }

    public function getAll(): DataCollection
    {
        return $this->lessonTransformer->transformArrayToCollection($this->lesson->all()->toArray());
    }

    public function getElementById(string $lessonIdFromRequest): LessonModel
    {
        return $this->lessonTransformer->transformToObject($this->lesson::find($lessonIdFromRequest));
    }

    public function getUsersInConcreteLesson(string $lessonId): DataCollection
    {
        $collectionUsersInConcreteLesson = new DataCollection();
        return $collectionUsersInConcreteLesson;
    }
}
