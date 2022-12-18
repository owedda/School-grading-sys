<?php

namespace Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Models\UserTypeEnum;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Transformer\EntityToModel\UserModelTransformer;
use PHPUnit\Framework\TestCase;

class UserModelTransformerTest extends TestCase
{
    private UserModelTransformer $userModelTransformer;
    private UserModel $userModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userModelTransformer = new UserModelTransformer();
        $this->exampleArray = [
            DatabaseConstants::USERS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
            DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
            DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
            DatabaseConstants::USERS_TABLE_NAME => 'Test',
            DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
            DatabaseConstants::USERS_TABLE_TYPE => 'Student',
        ];
        $this->userModel = new UserModel(
            $this->exampleArray[DatabaseConstants::USERS_TABLE_ID],
            $this->exampleArray[DatabaseConstants::USERS_TABLE_USERNAME],
            $this->exampleArray[DatabaseConstants::USERS_TABLE_EMAIL],
            $this->exampleArray[DatabaseConstants::USERS_TABLE_NAME],
            $this->exampleArray[DatabaseConstants::USERS_TABLE_LAST_NAME],
            $this->exampleArray[DatabaseConstants::USERS_TABLE_TYPE]
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->userModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->userModel, $actual);
    }

    public function testTransformToCollection(): void
    {
        $expected = new DataCollection();
        $expected->push($this->userModel, $this->userModel, $this->userModel);

        $manyExampleArrays = [$this->exampleArray, $this->exampleArray, $this->exampleArray];
        $actual = $this->userModelTransformer->transformToCollection($manyExampleArrays);

        $this->assertEquals($expected, $actual);
    }
}
