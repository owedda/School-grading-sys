<?php

namespace Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\ModelToDatabaseModel\LessonModelTransformer;
use App\Service\Grading\ValueObjects\DatabaseModel\LessonModel;
use PHPUnit\Framework\TestCase;

class LessonTransformerTest extends TestCase
{
    private LessonModelTransformer $lessonTransformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonTransformer = new LessonModelTransformer();
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function testTransformArrayToCollectionReturnsCollectionCorrect(): void
    {
        $dataArray = [
            '0' => [
                'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                'name' => 'Math',
            ],
            '1' => [
                'id' => 'b9d3ad00-ad31-4f5c-8b64-95735122ec5d',
                'name' => 'Biology',
            ]
        ];

        $expected = new DataCollection();
        $expected->push(
            new LessonModel($dataArray[0]['id'], $dataArray[0]['name']),
            new LessonModel($dataArray[1]['id'], $dataArray[1]['name'])
        );


        $actual = $this->lessonTransformer->transformArrayToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
