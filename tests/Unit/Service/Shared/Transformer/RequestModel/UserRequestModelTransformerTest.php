<?php

namespace Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\UserRequestModel;
use App\Service\Shared\Transformer\RequestModel\UserRequestModelTransformer;
use PHPUnit\Framework\TestCase;

class UserRequestModelTransformerTest extends TestCase
{
    private UserRequestModelTransformer $userRequestModelTransformer;
    private UserRequestModel $userRequestModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRequestModelTransformer = new UserRequestModelTransformer();
        $this->exampleArray = [
            RequestConstants::USER_REQUEST_USERNAME => 'test',
            RequestConstants::USER_REQUEST_NAME => 'test',
            RequestConstants::USER_REQUEST_LAST_NAME => 'test',
            RequestConstants::USER_REQUEST_EMAIL => 'test@test.test',
            RequestConstants::USER_REQUEST_PASSWORD => 'test',
        ];
        $this->userRequestModel = new UserRequestModel(
            $this->exampleArray[RequestConstants::USER_REQUEST_USERNAME],
            $this->exampleArray[RequestConstants::USER_REQUEST_NAME],
            $this->exampleArray[RequestConstants::USER_REQUEST_LAST_NAME],
            $this->exampleArray[RequestConstants::USER_REQUEST_EMAIL],
            $this->exampleArray[RequestConstants::USER_REQUEST_PASSWORD],
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->userRequestModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->userRequestModel, $actual);
    }
}
