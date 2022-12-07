<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\EntityToModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserLessonModel;

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
            $data['id'],
            $data['user_id'],
            $data['lesson_id']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('id', $data) ||
            !array_key_exists('user_id', $data) ||
            !array_key_exists('lesson_id', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
