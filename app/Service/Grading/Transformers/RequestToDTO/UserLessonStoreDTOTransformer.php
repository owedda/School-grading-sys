<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\UserLessonStoreDTO;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class UserLessonStoreDTOTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): UserLessonStoreDTO
    {
        return new UserLessonStoreDTO(
            $data['user-id'],
            $data['lesson-id']
        );
    }
}
