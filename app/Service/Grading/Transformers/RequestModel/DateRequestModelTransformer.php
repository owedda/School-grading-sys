<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Service\Grading\ValueObjects\RequestModel\DateRequestModel;
use DateTime;

final class DateRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): mixed
    {
        return new DateRequestModel(new DateTime($data['date']));
    }
}
