<?php

namespace App\Repositories\Evaluation;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DTO\CustomDTO\DateRangeDTO;
use App\Service\Grading\DTO\StoreDTO\EvaluationStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use DateTime;

interface EvaluationRepositoryInterface
{
    public function deleteElementById(string $id): void;

    public function save(EvaluationStoreDTO $requestDTO): void;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function getUserEvaluations(string $userId, DateRangeDTO $dateRange): DataCollection;

    public function setLessonEvaluationsTransformer(TransformerInterface $lessonEvaluationsTransformer): void;
}
