<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ResponseModel;

use App\Constants\RelationshipConstants;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Grading\ValueObjects\Model\EvaluationModel;
use App\Service\Grading\ValueObjects\Model\LessonModel;
use App\Service\Grading\ValueObjects\Model\UserLessonModel;
use App\Service\Grading\ValueObjects\ResponseModel\LessonEvaluationsResponseModel;

final class LessonEvaluationsResponseModelTransformer implements LessonEvaluationsResponseModelTransformerInterface
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
    public function transformArrayToObject(array $data): LessonEvaluationsResponseModel
    {
        /** @var UserLessonModel $userLessonModel */
        /** @var LessonModel $lessonModel */
        /** @var EvaluationModel $evaluationModelCollection */

        $userLessonModel = $this->userLessonTransformer->transformArrayToObject($data);
        $lessonModel = $this->lessonTransformer
            ->transformArrayToObject($data[RelationshipConstants::USERLESSON_LESSON]);
        $evaluationModelCollection = $this->evaluationTransformer
            ->transformArrayToCollection($data[RelationshipConstants::USERLESSON_EVALUATIONS]);

        return new LessonEvaluationsResponseModel($userLessonModel, $lessonModel, $evaluationModelCollection);
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
