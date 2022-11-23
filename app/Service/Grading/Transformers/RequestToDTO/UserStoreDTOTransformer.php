<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\UserStoreDTO;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class UserStoreDTOTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): UserStoreDTO
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
