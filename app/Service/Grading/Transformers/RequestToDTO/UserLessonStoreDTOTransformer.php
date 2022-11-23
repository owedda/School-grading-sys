<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\UserLessonStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class UserLessonStoreDTOTransformer implements TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): UserLessonStoreDTO
    {
        $this->validateArray($data);

        return new UserLessonStoreDTO(
            $data['user-id'],
            $data['lesson-id']
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('user-id', $data) ||
            !array_key_exists('lesson-id', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
