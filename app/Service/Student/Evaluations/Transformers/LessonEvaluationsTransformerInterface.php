<?php

namespace App\Service\Student\Evaluations\Transformers;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Student\Evaluations\DTO\Custom\LessonEvaluations;

interface LessonEvaluationsTransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): LessonEvaluations;

    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;
}
