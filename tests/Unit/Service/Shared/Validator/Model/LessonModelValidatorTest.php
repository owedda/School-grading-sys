<?php

namespace Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use Generator;
use PHPUnit\Framework\TestCase;

class LessonModelValidatorTest extends TestCase
{
    private LessonModelValidator $validator;
    private array $exampleData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new LessonModelValidator();
        $this->exampleData = [
            DatabaseConstants::LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
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
                DatabaseConstants::LESSONS_TABLE_NAME => 'Math'
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
        yield 'Where array doesnt contain ["' . DatabaseConstants::LESSONS_TABLE_ID . '"]' => [
            $data = [
                DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::LESSONS_TABLE_NAME . '"]' => [
            $data = [
                DatabaseConstants::LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15'
            ]
        ];
    }
}
