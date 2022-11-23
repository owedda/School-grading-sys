<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

final class LessonTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformToObject($lesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformToObject(array $data): LessonModel
    {
        $this->validateArray($data);

        return new LessonModel(
            $data['id'],
            $data['name']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('id', $data) ||
            !array_key_exists('name', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
