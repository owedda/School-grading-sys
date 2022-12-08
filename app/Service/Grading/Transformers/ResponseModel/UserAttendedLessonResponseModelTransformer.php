<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ResponseModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;
use App\Service\Grading\ValueObjects\Model\LessonModel;
use App\Service\Grading\ValueObjects\Model\UserLessonModel;
use App\Service\Grading\ValueObjects\ResponseModel\UserAttendedLessonResponseModel;

final class UserAttendedLessonResponseModelTransformer implements UserAttendedLessonResponseModelTransformerInterface
{
    private TransformerToObjectInterface $lessonTransformerToObject;
    private TransformerToObjectInterface $userLessonTransformerToObject;

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userAttendedLesson) {
            $collection->add($this->transformArrayToObject($userAttendedLesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): UserAttendedLessonResponseModel
    {
        if (isset($data['user_lesson'])) {
            return $this->getUserAttendingLesson($data);
        }
        return $this->getUserNotAttendingLesson($data);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getLessonModel(array $data): LessonModel
    {
        return $this->lessonTransformerToObject->transformArrayToObject($data);
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getUserAttendingLesson(array $data): UserAttendedLessonResponseModel
    {
        return new UserAttendedLessonResponseModel(
            $this->getLessonModel($data),
            $this->getUserLessonModel($data['user_lesson'])
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getUserNotAttendingLesson(array $data): UserAttendedLessonResponseModel
    {
        return new UserAttendedLessonResponseModel(
            $this->getLessonModel($data)
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function getUserLessonModel(array $data): UserLessonModel
    {
        return $this->userLessonTransformerToObject->transformArrayToObject($data);
    }

    public function setLessonTransformerToObject(TransformerToObjectInterface $lessonTransformerToObject): void
    {
        $this->lessonTransformerToObject = $lessonTransformerToObject;
    }

    public function setUserLessonTransformerToObject(TransformerToObjectInterface $userLessonTransformerToObject): void
    {
        $this->userLessonTransformerToObject = $userLessonTransformerToObject;
    }
}
