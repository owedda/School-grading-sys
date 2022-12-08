<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Grading\ValueObjects\RequestModel\UserRequestModel;

final class UserRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): UserRequestModel
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
