<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\Interfaces\TransformerInterface;

final class UserLessonTransformer implements TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add($this->transformToObject($userLesson));
        }

        return $collection;
    }

    public function transformToObject(mixed $data): UserLessonModel
    {
        return new UserLessonModel(
            $data['id'],
            $data['user_id'],
            $data['lesson_id']
        );
    }
}
