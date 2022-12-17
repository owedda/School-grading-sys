<?php

namespace Service\Grading\Transformers\ModelToDataModel;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
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
     * @throws ValidatorException
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


        $actual = $this->lessonTransformer->transformToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
