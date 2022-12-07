<?php

namespace App\Repositories\Lesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\LessonModel;

interface LessonRepositoryInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAll(): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getAllLessonsWithUserLessonsAttached(string $userId): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getElementById(string $id): LessonModel;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;
}
