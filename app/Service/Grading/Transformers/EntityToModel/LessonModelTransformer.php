<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\LessonModel;

final class LessonModelTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformArrayToObject($lesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): LessonModel
    {
        $this->validateArray($data);

        return new LessonModel(
            $data[DatabaseConstants::LESSONS_TABLE_ID],
            $data[DatabaseConstants::LESSONS_TABLE_NAME]
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists(DatabaseConstants::LESSONS_TABLE_ID, $data) ||
            !array_key_exists(DatabaseConstants::LESSONS_TABLE_NAME, $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
