<?php

declare(strict_types=1);

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Models\UserLesson;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

final class LessonRepository implements LessonRepositoryInterface
{
    private TransformerInterface $lessonTransformer;
    private TransformerInterface $studentEvaluationDTOTransformer;

    public function __construct(
        private readonly Lesson $lesson,
        private readonly UserLesson $userLesson
    ) {
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection
    {
        return $this->lessonTransformer->transformArrayToCollection($this->lesson->all()->toArray());
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): LessonModel
    {
        return $this->lessonTransformer->transformArrayToObject($this->lesson::findOrFail($id)->toArray());
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection
    {
        $arrayUserLessonsWithUsers = $this->userLesson
            ::where('lesson_id', $lessonId)
            ->with('user')
            ->with('evaluation', function ($q) use ($date) {
                $q->where('date', $date);
            })
            ->get()
            ->toArray();

        return new DataCollection(
            $this->studentEvaluationDTOTransformer
            ->transformArrayToCollection($arrayUserLessonsWithUsers)
        );
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function setStudentEvaluationDTOTransformer(TransformerInterface $studentEvaluationDTOTransformer): void
    {
        $this->studentEvaluationDTOTransformer = $studentEvaluationDTOTransformer;
    }
}
