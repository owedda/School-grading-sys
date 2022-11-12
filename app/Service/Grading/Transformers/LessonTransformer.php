<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Interfaces\TransformerInterface;

final class LessonTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add(
                new LessonModel(
                    $lesson['id'],
                    $lesson['name']
                )
            );
        }

        return $collection;
    }
}
