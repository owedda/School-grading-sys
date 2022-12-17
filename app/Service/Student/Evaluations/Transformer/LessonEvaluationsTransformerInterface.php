<?php

namespace App\Service\Student\Evaluations\Transformer;

use App\Service\Shared\Transformer\TransformerInterface;

interface LessonEvaluationsTransformerInterface extends TransformerInterface
{
    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void;

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;
}
