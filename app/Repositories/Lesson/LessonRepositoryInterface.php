<?php

namespace App\Repositories\Lesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

interface LessonRepositoryInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): LessonModel;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;

    public function setStudentEvaluationDTOTransformer(TransformerInterface $studentEvaluationDTOTransformer): void;
}
