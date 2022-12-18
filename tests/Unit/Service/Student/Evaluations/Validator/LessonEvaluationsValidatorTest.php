<?php

namespace Service\Student\Evaluations\Validator;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\EvaluationModelValidator;
use App\Service\Shared\Validator\Model\LessonModelValidator;
use App\Service\Shared\Validator\Model\UserLessonModelValidator;
use App\Service\Student\Evaluations\Validator\LessonEvaluationsValidator;
use Generator;
use PHPUnit\Framework\TestCase;

class LessonEvaluationsValidatorTest extends TestCase
{
    private LessonEvaluationsValidator $validator;
    private array $exampleData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new LessonEvaluationsValidator();
        $this->validator->setLessonModelValidator(new LessonModelValidator());
        $this->validator->setUserLessonModelValidator(new UserLessonModelValidator());
        $this->validator->setEvaluationModelValidator(new EvaluationModelValidator());
        $this->exampleData = [
            DatabaseConstants::USER_LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
            DatabaseConstants::USER_LESSONS_TABLE_USER_ID => '00000000-0000-0000-0000-000000000001',
            DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => '00000000-0000-0000-0000-000000000002',
            RelationshipConstants::USERLESSON_LESSON =>
            [
                DatabaseConstants::LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000003',
                DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
            ],
            RelationshipConstants::USERLESSON_EVALUATIONS =>
            [
                [
                    DatabaseConstants::EVALUATIONS_TABLE_ID => '00000000-0000-0000-0000-000000000004',
                    DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
                    DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
                ],
                [
                    DatabaseConstants::EVALUATIONS_TABLE_ID => '00000000-0000-0000-0000-000000000005',
                    DatabaseConstants::EVALUATIONS_TABLE_VALUE => 6,
                    DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-11',
                ]
            ],
        ];
    }

    /**
     * @throws ValidatorException
     */
    public function testValidateWhenCorrect(): void
    {
        $this->validator->validate([$this->exampleData, $this->exampleData]);
        $this->expectNotToPerformAssertions();
    }

    /**
     * @dataProvider validateElementDataProvider
     */
    public function testValidateWhenIncorrect(array $data): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage($this->validator::class . ' calling with incorrect argument');

        $this->validator->validate($data);
    }

    public function validateElementDataProvider(): Generator
    {
        yield 'Where array dont have array in ["' . RelationshipConstants::USERLESSON_EVALUATIONS . '"]' => [
            $data = [
                DatabaseConstants::USER_LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
                DatabaseConstants::USER_LESSONS_TABLE_USER_ID => '00000000-0000-0000-0000-000000000001',
                DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => '00000000-0000-0000-0000-000000000002',
                RelationshipConstants::USERLESSON_LESSON =>
                    [
                        DatabaseConstants::LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000003',
                        DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
                    ],
                RelationshipConstants::USERLESSON_EVALUATIONS =>
                    [
                        DatabaseConstants::EVALUATIONS_TABLE_ID => '00000000-0000-0000-0000-000000000004',
                        DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
                        DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
                    ],
            ]
        ];
        yield 'Where array doesnt contain ["' . RelationshipConstants::USERLESSON_EVALUATIONS . '"]' => [
            $data = [
                DatabaseConstants::USER_LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
                DatabaseConstants::USER_LESSONS_TABLE_USER_ID => '00000000-0000-0000-0000-000000000001',
                DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => '00000000-0000-0000-0000-000000000002',
                RelationshipConstants::USERLESSON_LESSON =>
                    [
                        DatabaseConstants::LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000003',
                        DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
                    ],
            ]
        ];
    }
}
