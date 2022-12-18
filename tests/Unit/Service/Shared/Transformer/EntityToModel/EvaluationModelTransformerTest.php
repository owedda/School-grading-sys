<?php

namespace Service\Shared\Transformer\EntityToModel;

use App\Constants\DatabaseConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;

class EvaluationModelTransformerTest extends TestCase
{
    private EvaluationModelTransformer $evaluationModelTransformer;
    private EvaluationModel $evaluationModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->evaluationModelTransformer = new EvaluationModelTransformer();
        $this->exampleArray = [
            DatabaseConstants::EVALUATIONS_TABLE_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
            DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
        ];
        $this->evaluationModel = new EvaluationModel(
            $this->exampleArray[DatabaseConstants::EVALUATIONS_TABLE_ID],
            $this->exampleArray[DatabaseConstants::EVALUATIONS_TABLE_VALUE],
            new DateTime($this->exampleArray[DatabaseConstants::EVALUATIONS_TABLE_DATE])
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->evaluationModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->evaluationModel, $actual);
    }

    public function testTransformToCollection(): void
    {
        $expected = new DataCollection();
        $expected->push($this->evaluationModel, $this->evaluationModel, $this->evaluationModel);

        $manyExampleArrays = [$this->exampleArray, $this->exampleArray, $this->exampleArray];
        $actual = $this->evaluationModelTransformer->transformToCollection($manyExampleArrays);

        $this->assertEquals($expected, $actual);
    }
}
