<?php

namespace Service\Grading\Transformers;

use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\UserLessonModelTransformer;
use App\Service\Shared\Transformers\EntityToModel\UserModelTransformer;
use App\Service\Shared\Transformers\TransformerInterface;
use Generator;
use PHPUnit\Framework\TestCase;

class TransformerExceptionTest extends TestCase
{
    /**
     * @dataProvider userTransformerDataProvider
     * @dataProvider lessonTransformerDataProvider
     * @dataProvider userLessonTransformerDataProvider
     * @dataProvider evaluationDTOTransformerDataProvider
     */
    public function testTransformArrayToCollectionThrowsException(
        TransformerInterface $transformer,
        array $dataArray
    ): void {

        $this->expectException(TransformerInvalidArgumentException::class);
        $this->expectExceptionMessage($transformer::class . ' calling with incorrect array argument');

        $actual = $transformer->transformArrayToCollection($dataArray);
    }

    public function userTransformerDataProvider(): Generator
    {
        yield 'UserModelTransformer testing if throws exception with incorrect array key' => [
            'transformer' => new UserModelTransformer(),
            'dataArray' => [
                '0' => [
                    'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                    'username' => 'test11',
                    'email' => 'test1@mail.com',
                    'name' => 'Jon',
                    'last_name' => 'Jones',
                    'type' => 'Student',
                ],
                '1' => [
                    'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                    'username' => 'test22',
                    'email' => 'test2@mail.com',
                    'test' => 'Someone',
                    'last_name' => 'Test',
                    'type' => 'Student',
                ]
            ]
        ];
    }

    public function lessonTransformerDataProvider(): Generator
    {
        yield 'LessonModelTransformer testing if throws exception with incorrect array key' => [
            'transformer' => new LessonModelTransformer(),
            'dataArray' => [
                '0' => [
                    'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                    'name' => 'Math',
                ],
                '1' => [
                    'id' => 'b9d3ad00-ad31-4f5c-8b64-95735122ec5d',
                    'test' => 'Biology',
                ]
            ]
        ];
    }

    public function userLessonTransformerDataProvider(): Generator
    {
        yield 'UserLessonModelTransformer testing if throws exception with incorrect array key' => [
            'transformer' => new UserLessonModelTransformer(),
            'dataArray' => [
                '0' => [
                    'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                    'user_id' => '2331a9fe-461c-43b6-8c78-5c21791cceb6',
                    'lesson_id' => 'dff72f1e-9b52-4c37-9cf6-a7164d47797d',
                ],
                '1' => [
                    'id' => 'b9d3ad00-ad31-4f5c-8b64-95735122ec5d',
                    'user_id' => '9b317380-1799-4bbc-bf65-20947dff8802',
                    'test' => '73dc9a74-9531-478e-9ddf-1477ca1d7553',
                ]
            ]
        ];
    }

    public function evaluationDTOTransformerDataProvider(): Generator
    {
        yield 'EvaluationModelTransformer testing if throws exception with incorrect array key' => [
            'transformer' => new EvaluationModelTransformer(),
            'dataArray' => [
                '0' => [
                    'value' => 10,
                    'date' => '2002-10-20',
                ],
                '1' => [
                    'value' => 5,
                    'test' => '2012-12-12',
                ]
            ]
        ];
        yield 'EvaluationModelTransformer testing if throws exception with incorrect array key value' => [
            'transformer' => new EvaluationModelTransformer(),
            'dataArray' => [
                '0' => [
                    'value' => '10',
                    'date' => '2002-10-20',
                ],
                '1' => [
                    'value' => 5,
                    'date' => '2012-12-12',
                ]
            ]
        ];
    }
}
