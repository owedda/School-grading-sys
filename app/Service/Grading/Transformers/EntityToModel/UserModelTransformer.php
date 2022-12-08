<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;
use App\Service\Grading\ValueObjects\Model\UserModel;

final class UserModelTransformer implements TransformerInterface
{
    /**
     * @throws TransformerInvalidArgumentException
     */
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $user) {
            $collection->add($this->transformArrayToObject($user));
        }

        return $collection;
    }

    public function transformArrayToObject(array $data): UserModel
    {
        $this->validateArray($data);

        return new UserModel(
            $data[DatabaseConstants::USERS_TABLE_ID],
            $data[DatabaseConstants::USERS_TABLE_USERNAME],
            $data[DatabaseConstants::USERS_TABLE_EMAIL],
            $data[DatabaseConstants::USERS_TABLE_NAME],
            $data[DatabaseConstants::USERS_TABLE_LAST_NAME],
            $data[DatabaseConstants::USERS_TABLE_TYPE],
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists(DatabaseConstants::USERS_TABLE_ID, $data) ||
            !array_key_exists(DatabaseConstants::USERS_TABLE_USERNAME, $data) ||
            !array_key_exists(DatabaseConstants::USERS_TABLE_EMAIL, $data) ||
            !array_key_exists(DatabaseConstants::USERS_TABLE_NAME, $data) ||
            !array_key_exists(DatabaseConstants::USERS_TABLE_LAST_NAME, $data) ||
            !array_key_exists(DatabaseConstants::USERS_TABLE_TYPE, $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
