<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\UserLessonStoreDTO;

class UserLessonStoreDTOTransformer
{
    public function transformToObject(mixed $data): UserLessonStoreDTO
    {
        return new UserLessonStoreDTO(
            $data['user-id'],
            $data['lesson-id']
        );
    }
}
