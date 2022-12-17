<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\UserLessonRequestModel;
use App\Service\Shared\Transformer\TransformerToObjectInterface;

final class UserLessonRequestModelTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): UserLessonRequestModel
    {
        return new UserLessonRequestModel(
            $data[RequestConstants::USER_LESSON_REQUEST_USER_ID],
            $data[RequestConstants::USER_LESSON_REQUEST_LESSON_ID]
        );
    }
}
