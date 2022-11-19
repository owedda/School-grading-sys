<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\UserStoreDTO;

final class UserStoreDTOTransformer
{
    public function transformToObject(mixed $data): UserStoreDTO
    {
        return new UserStoreDTO(
            $data['username'],
            $data['name'],
            $data['last-name'],
            $data['email'],
            $data['password'],
        );
    }
}
