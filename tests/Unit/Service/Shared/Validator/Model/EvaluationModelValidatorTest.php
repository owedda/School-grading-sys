<?php

namespace Service\Shared\Validator\Model;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\EvaluationModelValidator;
use Generator;
use PHPUnit\Framework\TestCase;

class EvaluationModelValidatorTest extends TestCase
{
    private EvaluationModelValidator $validator;
    private array $exampleData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new EvaluationModelValidator();
        $this->exampleData = [
            DatabaseConstants::EVALUATIONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
            DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
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
                DatabaseConstants::EVALUATIONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
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
        yield 'Where array doesnt contain ["' . DatabaseConstants::EVALUATIONS_TABLE_ID . '"]' => [
            $data = [
                DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
                DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::EVALUATIONS_TABLE_VALUE . '"]' => [
            $data = [
                DatabaseConstants::EVALUATIONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
            ]
        ];
        yield 'Where array doesnt contain ["' . DatabaseConstants::EVALUATIONS_TABLE_DATE . '"]' => [
            $data = [
                DatabaseConstants::EVALUATIONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
                DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
            ]
        ];
    }
}
