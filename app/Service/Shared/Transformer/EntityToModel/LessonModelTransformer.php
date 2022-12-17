<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\Transformer\TransformerInterface;

final class LessonModelTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $lesson) {
            $collection->add($this->transformToObject($lesson));
        }

        return $collection;
    }

    public function transformToObject(array $data): LessonModel
    {
        return new LessonModel(
            $data[DatabaseConstants::LESSONS_TABLE_ID],
            $data[DatabaseConstants::LESSONS_TABLE_NAME]
        );
    }
}
