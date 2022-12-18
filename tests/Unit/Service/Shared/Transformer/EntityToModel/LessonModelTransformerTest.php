<?php

namespace Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use PHPUnit\Framework\TestCase;

class LessonModelTransformerTest extends TestCase
{
    private LessonModelTransformer $lessonModelTransformer;
    private LessonModel $lessonModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonModelTransformer = new LessonModelTransformer();
        $this->exampleArray = [
            DatabaseConstants::LESSONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
        ];
        $this->lessonModel = new LessonModel(
            $this->exampleArray[DatabaseConstants::LESSONS_TABLE_ID],
            $this->exampleArray[DatabaseConstants::LESSONS_TABLE_NAME]
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->lessonModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->lessonModel, $actual);
    }

    public function testTransformToCollection(): void
    {
        $expected = new DataCollection();
        $expected->push($this->lessonModel, $this->lessonModel, $this->lessonModel);

        $manyExampleArrays = [$this->exampleArray, $this->exampleArray, $this->exampleArray];
        $actual = $this->lessonModelTransformer->transformToCollection($manyExampleArrays);

        $this->assertEquals($expected, $actual);
    }
}
