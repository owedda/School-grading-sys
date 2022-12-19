<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Teacher\Lessons\DTO\ResponseModel\UsersResponseModel;
use App\Service\Teacher\Lessons\Facade\ErrorHandler\LessonsServiceErrorHandlerInterface;
use App\Service\Teacher\Lessons\Facade\Repositories\LessonsServiceRepositoriesInterface;
use App\Service\Teacher\Lessons\Facade\Transformers\LessonsServiceTransformersInterface;

final class LessonsService implements LessonsServiceInterface
{
    public function __construct(
        private readonly LessonsServiceRepositoriesInterface $repositories,
        private readonly LessonsServiceErrorHandlerInterface $errorHandler,
        private readonly LessonsServiceTransformersInterface $transformers,
    ) {
    }

    public function getAllLessons(): DataCollection
    {
        $lessonsArray = $this->repositories->getLessonRepository()->getAll();

        $this->errorHandler->handleLessons($lessonsArray);

        return $this->transformers->getLessonTransformer()->transformToCollection($lessonsArray);
    }

    public function getUsersResponseModel(string $lessonId, array $date): UsersResponseModel
    {
        $dateRequestModel = $this->transformers->getDateRequestModelTransformer()->transformToObject($date);
        $studentsEvaluations = $this->getStudentsEvaluations($lessonId, $dateRequestModel);
        $lesson = $this->getLesson($lessonId);

        return new UsersResponseModel($studentsEvaluations, $lesson, $dateRequestModel->getDate());
    }

    public function storeEvaluation(array $evaluation): void
    {
        $evaluationRequestModel = $this->transformers
            ->getEvaluationRequestModelTransformer()
            ->transformToObject($evaluation);

        $this->repositories->getEvaluationRepository()->save($evaluationRequestModel);
    }

    public function destroyEvaluation(string $evaluationId): void
    {
        $this->repositories->getEvaluationRepository()->deleteElementById($evaluationId);
    }

    private function getLesson(string $id): LessonModel
    {
        $lessonArray = $this->repositories->getLessonRepository()->getElementById($id);

        $this->errorHandler->handleLesson($lessonArray);

        return $this->transformers->getLessonTransformer()->transformToObject($lessonArray);
    }

    private function getStudentsEvaluations(string $lessonId, DateRequestModel $dateRequestModel): DataCollection
    {
        $studentsEvaluationsArray = $this->repositories
            ->getUserLessonRepository()
            ->getStudentsWithEvaluationsInConcreteLesson($lessonId, $dateRequestModel->getDate());

        $this->errorHandler->handleStudentsEvaluations($studentsEvaluationsArray);

        return $this->transformers
            ->getStudentEvaluationResponseModelTransformer()
            ->transformToCollection($studentsEvaluationsArray);
    }
}
