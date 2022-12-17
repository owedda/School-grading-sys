<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Transformer;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Student\Evaluations\DTO\Custom\LessonEvaluations;

final class LessonEvaluationsTransformer implements LessonEvaluationsTransformerInterface
{
    private TransformerInterface $evaluationTransformer;
    private TransformerInterface $userLessonTransformer;
    private TransformerInterface $lessonTransformer;

    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lessonEvaluation) {
            $collection->add($this->transformToObject($lessonEvaluation));
        }

        return $collection;
    }

    public function transformToObject(array $data): LessonEvaluations
    {
        /** @var UserLessonModel $userLessonModel */
        /** @var LessonModel $lessonModel */
        /** @var EvaluationModel $evaluationModelCollection */

        $userLessonModel = $this->userLessonTransformer->transformToObject($data);
        $lessonModel = $this->lessonTransformer
            ->transformToObject($data[RelationshipConstants::USERLESSON_LESSON]);
        $evaluationModelCollection = $this->evaluationTransformer
            ->transformToCollection($data[RelationshipConstants::USERLESSON_EVALUATIONS]);

        return new LessonEvaluations($userLessonModel, $lessonModel, $evaluationModelCollection);
    }

    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void
    {
        $this->evaluationTransformer = $evaluationTransformer;
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void
    {
        $this->userLessonTransformer = $userLessonTransformer;
    }
}
