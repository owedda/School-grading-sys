<?php

namespace Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\UserModelValidator;
use Generator;
use PHPUnit\Framework\TestCase;

class UserModelValidatorTest extends TestCase
{
    private UserModelValidator $validator;
    private array $exampleData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new UserModelValidator();
        $this->exampleData = [
            DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
            DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
            DatabaseConstants::USERS_TABLE_NAME => 'Test',
            DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
            DatabaseConstants::USERS_TABLE_TYPE => 'Student',
        ];
    }

    /**
     * @throws ValidatorException
     */
    public function testValidateElementWhenCorrect(): void
    {
        $this->validator->validateElement($this->exampleData);
        $this->expectNotToPerformAssertions();
    }

    /**
     * @throws ValidatorException
     */
    public function testValidateManyWhenCorrect(): void
    {
        $data = [
            $this->exampleData,
            $this->exampleData
        ];

        $this->validator->validateMany($data);
        $this->expectNotToPerformAssertions();
    }

    public function testValidateManyWhenIncorrect(): void
    {
        $data = [
            $this->exampleData,
            [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ],
        ];

        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage($this->validator::class . ' calling with incorrect argument');

        $this->validator->validateMany($data);
    }

    /**
     * @dataProvider validateElementDataProvider
     */
    public function testValidateElementWhenIncorrect(array $data): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage($this->validator::class . ' calling with incorrect argument');

        $this->validator->validateElement($data);
    }

    public function validateElementDataProvider(): Generator
    {
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_ID . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_USERNAME . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_EMAIL . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_NAME . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_LAST_NAME . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_TYPE => 'Student',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USERS_TABLE_TYPE . '"]' => [
            $data = [
                DatabaseConstants::USERS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USERS_TABLE_USERNAME => 'Test',
                DatabaseConstants::USERS_TABLE_EMAIL => 'test@mail.com',
                DatabaseConstants::USERS_TABLE_NAME => 'Test',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Test',
            ]
        ];
    }
}
