<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Transformer\TransformerInterface;

final class UserModelTransformer implements TransformerInterface
{
    public function transformToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $user) {
            $collection->add($this->transformToObject($user));
        }

        return $collection;
    }

    public function transformToObject(array $data): UserModel
    {
        return new UserModel(
            $data[DatabaseConstants::USERS_TABLE_ID],
            $data[DatabaseConstants::USERS_TABLE_USERNAME],
            $data[DatabaseConstants::USERS_TABLE_EMAIL],
            $data[DatabaseConstants::USERS_TABLE_NAME],
            $data[DatabaseConstants::USERS_TABLE_LAST_NAME],
            $data[DatabaseConstants::USERS_TABLE_TYPE],
        );
    }
}
