<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Transformer;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\StudentEvaluationResponseModel;

final class StudentEvaluationResponseModelTransformer implements StudentEvaluationResponseModelTransformerInterface
{
    private TransformerInterface $userTransformer;
    private TransformerInterface $evaluationTransformer;
    private TransformerInterface $userLessonTransformer;

    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $studentEvaluation) {
            $collection->add($this->transformToObject($studentEvaluation));
        }

        return $collection;
    }

    public function transformToObject(array $data): StudentEvaluationResponseModel
    {
        $userLessonModel = $this->userLessonTransformer->transformToObject($data);
        $userModel = $this->userTransformer
            ->transformToObject($data[RelationshipConstants::USERLESSON_USER]);

        return $this->getStudentEvaluationResponseModel($data, $userModel, $userLessonModel);
    }

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

    private function getStudentWithEvaluation(
        UserModel $userModel,
        UserLessonModel $userLessonModel,
        array $data
    ): StudentEvaluationResponseModel {

        /** @var EvaluationModel $evaluationModel */
        $evaluationModel = $this->evaluationTransformer
            ->transformToObject($data[RelationshipConstants::USERLESSON_EVALUATION]);

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

    public function setUserTransformer(TransformerInterface $userTransformer): void
    {
        $this->userTransformer = $userTransformer;
    }

    public function setEvaluationTransformer(TransformerInterface $evaluationTransformer): void
    {
        $this->evaluationTransformer = $evaluationTransformer;
    }

    public function setUserLessonTransformer(TransformerInterface $userLessonTransformer): void
    {
        $this->userLessonTransformer = $userLessonTransformer;
    }
}
