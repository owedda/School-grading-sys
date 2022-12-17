<?php

declare(strict_types=1);

namespace App\Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Transformer\TransformerToObjectInterface;
use DateTime;

final class DateRequestModelTransformer implements TransformerToObjectInterface
{
    public function transformToObject(array $data): DateRequestModel
    {
        $date = new DateTime($data[RequestConstants::DATE_REQUEST_DATE]);
        return new DateRequestModel($date);
    }
}
