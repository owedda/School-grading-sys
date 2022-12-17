<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Transformer\TransformerInterface;

final class UserLessonModelTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add($this->transformToObject($userLesson));
        }

        return $collection;
    }

    public function transformToObject(array $data): UserLessonModel
    {
        return new UserLessonModel(
            $data[DatabaseConstants::USER_LESSONS_TABLE_ID],
            $data[DatabaseConstants::USER_LESSONS_TABLE_USER_ID],
            $data[DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID]
        );
    }
}
