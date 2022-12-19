<?php

namespace App\Service\Student\Evaluations\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformerInterface;

interface EvaluationsServiceTransformersInterface
{
    public function getDateRequestModelTransformer(): TransformerToObjectInterface;

    public function setDateRequestModelTransformer(TransformerToObjectInterface $dateRequestModelTransformer): void;

    public function getLessonEvaluationsTransformer(): LessonEvaluationsTransformerInterface;
}
