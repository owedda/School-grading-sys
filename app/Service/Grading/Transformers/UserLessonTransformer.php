<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserLessonModel;
use App\Service\Grading\Interfaces\TransformerInterface;

final class UserLessonTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add(
                new UserLessonModel(
                    $userLesson['id'],
                    $userLesson['user_id'],
                    $userLesson['lesson_id']
                )
            );
        }

        return $collection;
    }
}
