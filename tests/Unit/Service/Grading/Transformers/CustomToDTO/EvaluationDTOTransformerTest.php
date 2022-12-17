<?php

namespace Service\Grading\Transformers\CustomToDTO;

use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use PHPUnit\Framework\TestCase;

class EvaluationDTOTransformerTest extends TestCase
{
    private EvaluationModelTransformer $evaluationDTOTransformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->evaluationDTOTransformer = new EvaluationModelTransformer();
    }

    /**
     * @throws ValidatorException
     */
    public function testTransformArrayToCollectionReturnsCollectionCorrect(): void
    {
        $dataArray = [
            '0' => [
                'value' => 10,
                'date' => '2002-10-20',
            ],
            '1' => [
                'value' => 5,
                'date' => '2012-12-12',
            ]
        ];

        $expected = new DataCollection();
        $expected->push(
            new EvaluationModel($dataArray[0]['value'], '20'),
            new EvaluationModel($dataArray[1]['value'], '12')
        );

        $actual = $this->evaluationDTOTransformer->transformToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
