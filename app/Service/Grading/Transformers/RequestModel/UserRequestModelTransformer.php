<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;

final class UserRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): UserRequestModel
    {
        return new UserRequestModel(
            $data['username'],
            $data['name'],
            $data['last-name'],
            $data['email'],
            $data['password'],
        );
    }
}
