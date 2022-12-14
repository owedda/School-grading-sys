<?php

namespace Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\EvaluationRequestModel;
use App\Service\Shared\Transformer\RequestModel\EvaluationRequestModelTransformer;
use PHPUnit\Framework\TestCase;

class EvaluationRequestModelTest extends TestCase
{
    private EvaluationRequestModelTransformer $evaluationRequestModelTransformer;
    private EvaluationRequestModel $evaluationRequestModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->evaluationRequestModelTransformer = new EvaluationRequestModelTransformer();
        $this->exampleArray = [
            RequestConstants::EVALUATION_REQUEST_VALUE => 10,
            RequestConstants::EVALUATION_REQUEST_USER_LESSON_ID => '00000000-0000-0000-0000-000000000000',
            RequestConstants::EVALUATION_REQUEST_DATE => '2022-12-12',
        ];
        $this->evaluationRequestModel = new EvaluationRequestModel(
            $this->exampleArray[RequestConstants::EVALUATION_REQUEST_VALUE],
            $this->exampleArray[RequestConstants::EVALUATION_REQUEST_USER_LESSON_ID],
            $this->exampleArray[RequestConstants::EVALUATION_REQUEST_DATE],
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->evaluationRequestModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->evaluationRequestModel, $actual);
    }
}
