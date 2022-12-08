<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

final class UserLessonRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): UserLessonRequestModel
    {
        return new UserLessonRequestModel(
            $data[RequestConstants::USER_LESSON_REQUEST_USER_ID],
            $data[RequestConstants::USER_LESSON_REQUEST_LESSON_ID]
        );
    }
}
