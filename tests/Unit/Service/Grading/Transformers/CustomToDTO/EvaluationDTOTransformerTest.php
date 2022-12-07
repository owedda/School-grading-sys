<?php

namespace Service\Grading\Transformers\CustomToDTO;

use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Exception\TransformerInvalidArgumentException;
use App\Service\Grading\Transformers\ModelToDatabaseModel\EvaluationModelTransformer;
use App\Service\Grading\ValueObjects\DatabaseModel\EvaluationModel;
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
     * @throws TransformerInvalidArgumentException
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

        $actual = $this->evaluationDTOTransformer->transformArrayToCollection($dataArray);
        $this->assertEquals($expected, $actual);
    }
}
