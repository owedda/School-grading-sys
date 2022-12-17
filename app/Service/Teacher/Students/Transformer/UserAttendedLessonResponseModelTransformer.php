<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\Transformer;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Transformer\TransformerInterface;
use App\Service\Teacher\Students\DTO\ResponseModel\UserAttendedLessonResponseModel;

final class UserAttendedLessonResponseModelTransformer implements UserAttendedLessonResponseModelTransformerInterface
{
    private TransformerInterface $lessonTransformer;
    private TransformerInterface $userLessonTransformer;

    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userAttendedLesson) {
            $collection->add($this->transformToObject($userAttendedLesson));
        }

        return $collection;
    }

    public function transformToObject(array $data): UserAttendedLessonResponseModel
    {
        if (isset($data['user_lesson'])) {
            return $this->getUserAttendingLesson($data);
        }
        return $this->getUserNotAttendingLesson($data);
    }

    private function getLessonModel(array $data): LessonModel
    {
        return $this->lessonTransformer->transformToObject($data);
    }

    private function getUserAttendingLesson(array $data): UserAttendedLessonResponseModel
    {
        return new UserAttendedLessonResponseModel(
            $this->getLessonModel($data),
            $this->getUserLessonModel($data['user_lesson'])
        );
    }

    private function getUserNotAttendingLesson(array $data): UserAttendedLessonResponseModel
    {
        return new UserAttendedLessonResponseModel(
            $this->getLessonModel($data)
        );
    }

    private function getUserLessonModel(array $data): UserLessonModel
    {
        return $this->userLessonTransformer->transformToObject($data);
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
