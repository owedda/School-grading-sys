<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Transformers\TransformerInterface;

final class LessonTransformer implements TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformToObject($lesson));
        }

        return $collection;
    }

    public function transformToObject(mixed $data): LessonModel
    {
        return new LessonModel(
            $data['id'],
            $data['name']
        );
    }
}
