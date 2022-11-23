<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\TransformerInterface;

final class UserTransformer implements TransformerInterface
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
            $data['id'],
            $data['username'],
            $data['email'],
            $data['name'],
            $data['last_name'],
            $data['type'],
        );
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    private function validateArray(array $data): void
    {
        if (
            !array_key_exists('id', $data) ||
            !array_key_exists('username', $data) ||
            !array_key_exists('email', $data) ||
            !array_key_exists('name', $data) ||
            !array_key_exists('last_name', $data) ||
            !array_key_exists('type', $data)
        ) {
            throw new TransformerInvalidArgumentException(__CLASS__);
        }
    }
}
