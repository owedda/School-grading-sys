<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\UserModel;
use App\Service\Grading\Transformers\TransformerInterface;

final class UserTransformer implements TransformerInterface
{
    public function transformArrayToCollection(array $data): DataCollection
    {
        $collection = new DataCollection();

        foreach ($data as $user) {
            $collection->add($this->transformToObject($user));
        }

        return $collection;
    }

    public function transformToObject(mixed $data): UserModel
    {
        return new UserModel(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['name'],
            $data['last_name'],
            $data['type'],
        );
    }
}
