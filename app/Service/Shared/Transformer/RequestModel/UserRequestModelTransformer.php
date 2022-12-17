<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\UserRequestModel;
use App\Service\Shared\Transformer\TransformerToObjectInterface;

final class UserRequestModelTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): UserRequestModel
    {
        return new UserRequestModel(
            $data[RequestConstants::USER_REQUEST_USERNAME],
            $data[RequestConstants::USER_REQUEST_NAME],
            $data[RequestConstants::USER_REQUEST_LAST_NAME],
            $data[RequestConstants::USER_REQUEST_EMAIL],
            $data[RequestConstants::USER_REQUEST_PASSWORD],
        );
    }
}
