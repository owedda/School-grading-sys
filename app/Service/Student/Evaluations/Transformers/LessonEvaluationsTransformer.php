<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations\Transformers;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Student\Evaluations\DTO\Custom\LessonEvaluations;

final class LessonEvaluationsTransformer implements LessonEvaluationsTransformerInterface
{
    private TransformerInterface $evaluationTransformer;
    private TransformerInterface $userLessonTransformer;
    private TransformerInterface $lessonTransformer;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lessonEvaluation) {
            $collection->add($this->transformArrayToObject($lessonEvaluation));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): LessonEvaluations
    {
        /** @var UserLessonModel $userLessonModel */
        /** @var LessonModel $lessonModel */
        /** @var EvaluationModel $evaluationModelCollection */

        $userLessonModel = $this->userLessonTransformer->transformArrayToObject($data);
        $lessonModel = $this->lessonTransformer
            ->transformArrayToObject($data[RelationshipConstants::USERLESSON_LESSON]);
        $evaluationModelCollection = $this->evaluationTransformer
            ->transformArrayToCollection($data[RelationshipConstants::USERLESSON_EVALUATIONS]);

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
