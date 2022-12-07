<?php

namespace App\Repositories\Evaluation;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\EvaluationRequestModel;

interface EvaluationRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(EvaluationRequestModel $requestDTO): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRange $dateRange): DataCollection;

    public function setLessonEvaluationsTransformer(TransformerInterface $lessonEvaluationsTransformer): void;
}
