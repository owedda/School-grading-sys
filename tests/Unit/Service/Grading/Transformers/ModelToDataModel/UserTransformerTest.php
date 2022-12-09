<?php

namespace Service\Grading\Transformers\ModelToDataModel;

use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\Model\UserModel;
use App\Service\Shared\Exception\TransformerInvalidArgumentException;
use App\Service\Shared\Transformers\EntityToModel\UserModelTransformer;
use PHPUnit\Framework\TestCase;

class UserTransformerTest extends TestCase
{
    private UserModelTransformer $userTransformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userTransformer = new UserModelTransformer();
    }

    /**
     * @throws TransformerInvalidArgumentException
     */
    public function testTransformArrayToCollectionReturnsCollectionCorrect(): void
    {
        $dataArray = [
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
                'name' => 'Someone',
                'last_name' => 'Test',
                'type' => 'Student',
            ]
        ];

        $expected = new DataCollection();
        $expected->push(
            new UserModel(
                $dataArray[0]['id'],
                $dataArray[0]['username'],
                $dataArray[0]['email'],
                $dataArray[0]['name'],
                $dataArray[0]['last_name'],
                $dataArray[0]['type']
            ),
            new UserModel(
                $dataArray[1]['id'],
                $dataArray[1]['username'],
                $dataArray[1]['email'],
                $dataArray[1]['name'],
                $dataArray[1]['last_name'],
                $dataArray[1]['type']
            )
        );

        $actual = $this->userTransformer->transformArrayToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
