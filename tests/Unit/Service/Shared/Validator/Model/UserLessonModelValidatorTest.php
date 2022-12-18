<?php

namespace Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
use Generator;
use PHPUnit\Framework\TestCase;

class UserLessonModelValidatorTest extends TestCase
{
    private UserLessonModelValidator $validator;
    private array $exampleData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new UserLessonModelValidator();
        $this->exampleData = [
            DatabaseConstants::USER_LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::USER_LESSONS_TABLE_USER_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
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
                DatabaseConstants::USER_LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
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
        yield 'Where array doesnt contain ["' . DatabaseConstants::USER_LESSONS_TABLE_ID . '"]' => [
            $data = [
                DatabaseConstants::USER_LESSONS_TABLE_USER_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15'
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USER_LESSONS_TABLE_USER_ID . '"]' => [
            $data = [
                DatabaseConstants::USER_LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15'
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID . '"]' => [
            $data = [
                DatabaseConstants::USER_LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::USER_LESSONS_TABLE_USER_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15'
            ]
        ];
    }
}
