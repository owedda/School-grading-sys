<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Transformers;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerToObjectInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\StudentEvaluationResponseModel;

final class StudentEvaluationResponseModelTransformer implements StudentEvaluationResponseModelTransformerInterface
{
    private TransformerToObjectInterface $userTransformerToObject;
    private TransformerToObjectInterface $evaluationTransformerToObject;
    private TransformerToObjectInterface $userLessonTransformerToObject;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $studentEvaluation) {
            $collection->add($this->transformArrayToObject($studentEvaluation));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): StudentEvaluationResponseModel
    {
        $userLessonModel = $this->userLessonTransformerToObject->transformArrayToObject($data);
        $userModel = $this->userTransformerToObject
            ->transformArrayToObject($data[RelationshipConstants::USERLESSON_USER]);

        return $this->getStudentEvaluationResponseModel($data, $userModel, $userLessonModel);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getStudentEvaluationResponseModel(
        array $data,
        UserModel $userModel,
        UserLessonModel $userLessonModel
    ): StudentEvaluationResponseModel {

        if (isset($data[RelationshipConstants::USERLESSON_EVALUATION])) {
            return $this->getStudentWithEvaluation($userModel, $userLessonModel, $data);
        }
        return $this->getStudentWithNoEvaluation($userModel, $userLessonModel);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getStudentWithEvaluation(
        UserModel $userModel,
        UserLessonModel $userLessonModel,
        array $data
    ): StudentEvaluationResponseModel {

        /** @var EvaluationModel $evaluationModel */
        $evaluationModel = $this->evaluationTransformerToObject
            ->transformArrayToObject($data[RelationshipConstants::USERLESSON_EVALUATION]);

        return new StudentEvaluationResponseModel(
            $userModel,
            $userLessonModel,
            $evaluationModel
        );
    }

    private function getStudentWithNoEvaluation(
        UserModel $userModel,
        UserLessonModel $userLessonModel
    ): StudentEvaluationResponseModel {

        return new StudentEvaluationResponseModel(
            $userModel,
            $userLessonModel
        );
    }

    public function setUserTransformerToObject(TransformerToObjectInterface $userTransformerToObject): void
    {
        $this->userTransformerToObject = $userTransformerToObject;
    }

    public function setEvaluationTransformerToObject(TransformerToObjectInterface $evaluationTransformerToObject): void
    {
        $this->evaluationTransformerToObject = $evaluationTransformerToObject;
    }

    public function setUserLessonTransformerToObject(TransformerToObjectInterface $userLessonTransformerToObject): void
    {
        $this->userLessonTransformerToObject = $userLessonTransformerToObject;
    }
}
