<?php

namespace Service\Grading\Transformers\ModelToDataModel;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use PHPUnit\Framework\TestCase;

class UserLessonTransformerTest extends TestCase
{
    private UserLessonModelTransformer $userLessonTransformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLessonTransformer = new UserLessonModelTransformer();
    }

    /**
     * @throws ValidatorException
     */
    public function testTransformArrayToCollectionReturnsCollectionCorrect(): void
    {
        $dataArray = [
            '0' => [
                'id' => '20dca277-fd64-4d85-ba60-2ce7a529b3a7',
                'user_id' => '2331a9fe-461c-43b6-8c78-5c21791cceb6',
                'lesson_id' => 'dff72f1e-9b52-4c37-9cf6-a7164d47797d',
            ],
            '1' => [
                'id' => 'b9d3ad00-ad31-4f5c-8b64-95735122ec5d',
                'user_id' => '9b317380-1799-4bbc-bf65-20947dff8802',
                'lesson_id' => '73dc9a74-9531-478e-9ddf-1477ca1d7553',
            ]
        ];

        $expected = new DataCollection();
        $expected->push(
            new UserLessonModel($dataArray[0]['id'], $dataArray[0]['user_id'], $dataArray[0]['lesson_id']),
            new UserLessonModel($dataArray[1]['id'], $dataArray[1]['user_id'], $dataArray[1]['lesson_id'])
        );

        $actual = $this->userLessonTransformer->transformToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
