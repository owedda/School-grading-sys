<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformers\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\TransformerInterface;

final class UserLessonModelTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $userLesson) {
            $collection->add($this->transformArrayToObject($userLesson));
        }

        return $collection;
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): UserLessonModel
    {
        $this->validateArray($data);

        return new UserLessonModel(
            $data[DatabaseConstants::USER_LESSONS_TABLE_ID],
            $data[DatabaseConstants::USER_LESSONS_TABLE_USER_ID],
            $data[DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID]
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists(DatabaseConstants::USER_LESSONS_TABLE_ID, $data) ||
            !array_key_exists(DatabaseConstants::USER_LESSONS_TABLE_USER_ID, $data) ||
            !array_key_exists(DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID, $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
