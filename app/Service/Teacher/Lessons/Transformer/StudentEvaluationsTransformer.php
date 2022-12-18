<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons\Transformer;

use App\Constants\RelationshipConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Teacher\Lessons\DTO\Custom\StudentEvaluations;

final class StudentEvaluationsTransformer implements StudentEvaluationsTransformerInterface
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

    public function transformToObject(array $data): StudentEvaluations
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
    ): StudentEvaluations {

        if (isset($data[RelationshipConstants::USERLESSON_EVALUATION])) {
            return $this->getStudentWithEvaluation($userModel, $userLessonModel, $data);
        }
        return $this->getStudentWithNoEvaluation($userModel, $userLessonModel);
    }

    private function getStudentWithEvaluation(
        UserModel $userModel,
        UserLessonModel $userLessonModel,
        array $data
    ): StudentEvaluations {

        /** @var EvaluationModel $evaluationModel */
        $evaluationModel = $this->evaluationTransformer
            ->transformToObject($data[RelationshipConstants::USERLESSON_EVALUATION]);

        return new StudentEvaluations(
            $userModel,
            $userLessonModel,
            $evaluationModel
        );
    }

    private function getStudentWithNoEvaluation(
        UserModel $userModel,
        UserLessonModel $userLessonModel
    ): StudentEvaluations {

        return new StudentEvaluations(
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
