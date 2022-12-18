<?php

namespace App\Service\Teacher\Lessons\Transformer;

use App\Service\Shared\Transformer\TransformerInterface;

interface StudentEvaluationsTransformerInterface extends TransformerInterface
{
    public function setUserTransformer(TransformerInterface $userTransformer): void;

    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void;

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void;
}
