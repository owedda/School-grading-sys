<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;

final class LessonsServiceTransformers implements LessonsServiceTransformersInterface
{
    private TransformerToObjectInterface $evaluationRequestModelTransformer;
    private TransformerToObjectInterface $dateRequestModelTransformer;
    private TransformerInterface $lessonTransformer;

    public function __construct(
        private readonly StudentEvaluationsTransformerInterface $studentEvaluationResponseModelTransformer
    ) {
    }

    public function getEvaluationRequestModelTransformer(): TransformerToObjectInterface
    {
        return $this->evaluationRequestModelTransformer;
    }

    public function setEvaluationRequestModelTransformer(
        TransformerToObjectInterface $evaluationRequestModelTransformer
    ): void {
        $this->evaluationRequestModelTransformer = $evaluationRequestModelTransformer;
    }

    public function getDateRequestModelTransformer(): TransformerToObjectInterface
    {
        return $this->dateRequestModelTransformer;
    }

    public function setDateRequestModelTransformer(TransformerToObjectInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }

    public function getLessonTransformer(): TransformerInterface
    {
        return $this->lessonTransformer;
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function getStudentEvaluationResponseModelTransformer(): StudentEvaluationsTransformerInterface
    {
        return $this->studentEvaluationResponseModelTransformer;
    }
}
