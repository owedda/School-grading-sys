<?php

namespace App\Service\Teacher\Lessons\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;

interface LessonsServiceTransformersInterface
{
    public function getEvaluationRequestModelTransformer(): TransformerToObjectInterface;

    public function setEvaluationRequestModelTransformer(
        TransformerToObjectInterface $evaluationRequestModelTransformer
    ): void;

    public function getDateRequestModelTransformer(): TransformerToObjectInterface;

    public function setDateRequestModelTransformer(TransformerToObjectInterface $dateRequestModelTransformer): void;

    public function getLessonTransformer(): TransformerInterface;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;

    public function getStudentEvaluationResponseModelTransformer(): StudentEvaluationsTransformerInterface;
}
