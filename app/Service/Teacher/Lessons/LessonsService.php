<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Shared\Transformers\TransformerInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\UsersResponseModel;
use App\Service\Teacher\Lessons\Transformers\StudentEvaluationResponseModelTransformerInterface;

final class LessonsService implements LessonsServiceInterface
{
    private RequestModelTransformerInterface $evaluationRequestModelTransformer;
    private RequestModelTransformerInterface $dateRequestModelTransformer;
    private TransformerInterface $lessonTransformer;

    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly EvaluationRepositoryInterface $evaluationRepository,
        private readonly StudentEvaluationResponseModelTransformerInterface $studentEvaluationResponseModelTransformer
    ) {
    }

    public function getAllLessons(): DataCollection
    {
        $lessonsArray = $this->lessonRepository->getAll();
        return $this->lessonTransformer->transformArrayToCollection($lessonsArray);
    }

    public function getUsersResponseModel(string $lessonId, array $date): UsersResponseModel
    {
        $dateRequestModel = $this->dateRequestModelTransformer->transformArrayToObject($date);
        $usersEvaluations = $this->getUsersEvaluations($lessonId, $dateRequestModel);
        $lesson = $this->getLesson($lessonId);

        return new UsersResponseModel($usersEvaluations, $lesson, $dateRequestModel->getDate());
    }

    public function storeEvaluation(array $evaluation): void
    {
        $evaluationRequestModel = $this->evaluationRequestModelTransformer->transformArrayToObject($evaluation);
        $this->evaluationRepository->save($evaluationRequestModel);
    }

    public function destroyEvaluation(string $evaluationId): void
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
    }

    private function getLesson(string $id): LessonModel
    {
        $lessonArray = $this->lessonRepository->getElementById($id);
        return $this->lessonTransformer->transformArrayToObject($lessonArray);
    }

    private function getUsersEvaluations(string $lessonId, DateRequestModel $dateRequestModel): DataCollection
    {
        $usersEvaluationsArray = $this->userLessonRepository
            ->getUsersWithEvaluationsInConcreteLesson($lessonId, $dateRequestModel->getDate());

        return $this->studentEvaluationResponseModelTransformer->transformArrayToCollection($usersEvaluationsArray);
    }

    public function setEvaluationRequestModelTransformer(
        RequestModelTransformerInterface $evaluationRequestModelTransformer
    ): void {

        $this->evaluationRequestModelTransformer = $evaluationRequestModelTransformer;
    }

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }
}
