<?php

namespace Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use PHPUnit\Framework\TestCase;

class UserLessonModelTransformerTest extends TestCase
{
    private UserLessonModelTransformer $userLessonModelTransformer;
    private UserLessonModel $userLessonModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLessonModelTransformer = new UserLessonModelTransformer();
        $this->exampleArray = [
            DatabaseConstants::USER_LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
            DatabaseConstants::USER_LESSONS_TABLE_USER_ID => '00000000-0000-0000-0000-000000000001',
            DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => '00000000-0000-0000-0000-000000000002',
        ];
        $this->userLessonModel = new UserLessonModel(
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_ID],
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_USER_ID],
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID]
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->userLessonModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->userLessonModel, $actual);
    }

    public function testTransformToCollection(): void
    {
        $expected = new DataCollection();
        $expected->push($this->userLessonModel, $this->userLessonModel, $this->userLessonModel);

        $manyExampleArrays = [$this->exampleArray, $this->exampleArray, $this->exampleArray];
        $actual = $this->userLessonModelTransformer->transformToCollection($manyExampleArrays);

        $this->assertEquals($expected, $actual);
    }
}
