<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Facade\Transformers;

use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformerInterface;

final class EvaluationsServiceTransformers implements EvaluationsServiceTransformersInterface
{
    private TransformerToObjectInterface $dateRequestModelTransformer;

    public function __construct(private readonly LessonEvaluationsTransformerInterface $lessonEvaluationsTransformer)
    {
    }

    public function getDateRequestModelTransformer(): TransformerToObjectInterface
    {
        return $this->dateRequestModelTransformer;
    }

    public function setDateRequestModelTransformer(TransformerToObjectInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }

    public function getLessonEvaluationsTransformer(): LessonEvaluationsTransformerInterface
    {
        return $this->lessonEvaluationsTransformer;
    }
}
