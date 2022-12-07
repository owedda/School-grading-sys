<?php

namespace App\Repositories\UserLesson;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

interface UserLessonRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(UserLessonRequestModel $requestModel): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUsersInConcreteLesson(string $lessonId, string $date): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRange $dateRange): DataCollection;

    public function setStudentEvaluationDTOTransformer(TransformerInterface $studentEvaluationDTOTransformer): void;

    public function setLessonEvaluationsTransformer(TransformerInterface $lessonEvaluationsTransformer): void;
}
