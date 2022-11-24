<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestToDTO;

use App\Service\Grading\DTO\StoreDTO\UserStoreDTO;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerToObjectInterface;

final class UserStoreDTOTransformer implements TransformerToObjectInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToObject(array $data): UserStoreDTO
    {
        $this->validateArray($data);

        return new UserStoreDTO(
            $data['username'],
            $data['name'],
            $data['last-name'],
            $data['email'],
            $data['password'],
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('username', $data) ||
            !array_key_exists('name', $data) ||
            !array_key_exists('last-name', $data) ||
            !array_key_exists('email', $data) ||
            !array_key_exists('password', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
