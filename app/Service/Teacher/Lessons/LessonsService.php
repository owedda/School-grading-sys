<?php

declare(strict_types=1);

namespace App\Service\Teacher\Lessons;

use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Teacher\Lessons\DTO\ResponseModel\UsersResponseModel;
use App\Service\Teacher\Lessons\Transformer\StudentEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\Validator\StudentEvaluationsValidatorInterface;
use Psr\Log\LoggerInterface;

final class LessonsService implements LessonsServiceInterface
{
    private TransformerToObjectInterface $evaluationRequestModelTransformer;
    private TransformerToObjectInterface $dateRequestModelTransformer;
    private TransformerInterface $lessonTransformer;
    private ValidatorInterface $lessonModelValidator;

    public function __construct(
        private readonly LessonRepositoryInterface $lessonRepository,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly EvaluationRepositoryInterface $evaluationRepository,
        private readonly StudentEvaluationsTransformerInterface $studentEvaluationResponseModelTransformer,
        private readonly StudentEvaluationsValidatorInterface $studentEvaluationResponseModelValidator,
        private readonly LoggerInterface $logger
    ) {
    }

    public function getAllLessons(): DataCollection
    {
        $lessonsArray = $this->lessonRepository->getAll();

        try {
            $this->lessonModelValidator->validateMany($lessonsArray);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }

        return $this->lessonTransformer->transformToCollection($lessonsArray);
    }

    public function getUsersResponseModel(string $lessonId, array $date): UsersResponseModel
    {
        $dateRequestModel = $this->dateRequestModelTransformer->transformToObject($date);
        $studentsEvaluations = $this->getStudentsEvaluations($lessonId, $dateRequestModel);
        $lesson = $this->getLesson($lessonId);

        return new UsersResponseModel($studentsEvaluations, $lesson, $dateRequestModel->getDate());
    }

    public function storeEvaluation(array $evaluation): void
    {
        $evaluationRequestModel = $this->evaluationRequestModelTransformer->transformToObject($evaluation);
        $this->evaluationRepository->save($evaluationRequestModel);
    }

    public function destroyEvaluation(string $evaluationId): void
    {
        $this->evaluationRepository->deleteElementById($evaluationId);
    }

    private function getLesson(string $id): LessonModel
    {
        $lessonArray = $this->lessonRepository->getElementById($id);

        try {
            $this->lessonModelValidator->validateElement($lessonArray);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }

        return $this->lessonTransformer->transformToObject($lessonArray);
    }

    private function getStudentsEvaluations(string $lessonId, DateRequestModel $dateRequestModel): DataCollection
    {
        $usersEvaluationsArray = $this->userLessonRepository
            ->getStudentsWithEvaluationsInConcreteLesson($lessonId, $dateRequestModel->getDate());

        try {
            $this->studentEvaluationResponseModelValidator->validate($usersEvaluationsArray);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }

        return $this->studentEvaluationResponseModelTransformer->transformToCollection($usersEvaluationsArray);
    }

    public function setEvaluationRequestModelTransformer(
        TransformerToObjectInterface $evaluationRequestModelTransformer
    ): void {

        $this->evaluationRequestModelTransformer = $evaluationRequestModelTransformer;
    }

    public function setDateRequestModelTransformer(TransformerToObjectInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }

    public function setLessonTransformer(TransformerInterface $lessonTransformer): void
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function setLessonModelValidator(ValidatorInterface $lessonModelValidator): void
    {
        $this->lessonModelValidator = $lessonModelValidator;
    }
}
