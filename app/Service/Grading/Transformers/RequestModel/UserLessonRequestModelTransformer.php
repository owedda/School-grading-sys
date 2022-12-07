<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Service\Grading\ValueObjects\RequestModel\UserLessonRequestModel;

final class UserLessonRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): UserLessonRequestModel
    {
        return new UserLessonRequestModel(
            $data['user-id'],
            $data['lesson-id']
        );
    }
}
