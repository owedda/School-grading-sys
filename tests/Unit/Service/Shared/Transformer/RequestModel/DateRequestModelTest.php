<?php

namespace Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Transformer\RequestModel\DateRequestModelTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateRequestModelTest extends TestCase
{
    private DateRequestModelTransformer $dateRequestModelTransformer;
    private DateRequestModel $dateRequestModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dateRequestModelTransformer = new DateRequestModelTransformer();
        $this->exampleArray = [
            RequestConstants::DATE_REQUEST_DATE => '2022-12-22'
        ];
        $this->dateRequestModel = new DateRequestModel(
            new DateTime($this->exampleArray[RequestConstants::DATE_REQUEST_DATE])
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->dateRequestModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->dateRequestModel, $actual);
    }
}
