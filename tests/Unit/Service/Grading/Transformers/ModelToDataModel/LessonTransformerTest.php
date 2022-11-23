<?php

namespace Service\Grading\Transformers\ModelToDataModel;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\DataModel\LessonModel;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\ModelToDataModel\LessonTransformer;
use PHPUnit\Framework\TestCase;

class LessonTransformerTest extends TestCase
{
    private LessonTransformer $lessonTransformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonTransformer = new LessonTransformer();
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

    public function testTransformArrayToCollectionThrowsException(): void
    {
        $dataArray = [
            '0' => [
                'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                'name' => 'Math',
            ],
            '1' => [
                'id' => 'b9d3ad00-ad31-4f5c-8b64-95735122ec5d',
                'test' => 'Biology',
            ]
        ];

        $this->expectException(TransformerInvalidArgumentException::class);
        $this->expectExceptionMessage(LessonTransformer::class . ' got incorrect array argument');

        $actual = $this->lessonTransformer->transformArrayToCollection($dataArray);
    }


    public function testTransformToObject(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
