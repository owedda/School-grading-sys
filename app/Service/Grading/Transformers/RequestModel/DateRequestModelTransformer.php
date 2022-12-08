<?php

declare(strict_types=1);

namespace App\Service\Grading\Transformers\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Grading\ValueObjects\RequestModel\DateRequestModel;
use DateTime;

final class DateRequestModelTransformer implements RequestModelTransformerInterface
{
    public function transformArrayToObject(array $data): mixed
    {
        $date = new DateTime($data[RequestConstants::DATE_REQUEST_DATE]);
        return new DateRequestModel($date);
    }
}
