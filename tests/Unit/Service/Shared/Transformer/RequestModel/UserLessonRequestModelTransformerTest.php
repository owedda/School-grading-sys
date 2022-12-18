<?php

namespace Service\Shared\Transformer\RequestModel;

use App\Constants\RequestConstants;
use App\Service\Shared\DTO\RequestModel\UserLessonRequestModel;
use App\Service\Shared\Transformer\RequestModel\UserLessonRequestModelTransformer;
use PHPUnit\Framework\TestCase;

class UserLessonRequestModelTransformerTest extends TestCase
{
    private UserLessonRequestModelTransformer $userLessonRequestModelTransformer;
    private UserLessonRequestModel $userLessonRequestModel;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLessonRequestModelTransformer = new UserLessonRequestModelTransformer();
        $this->exampleArray = [
            RequestConstants::USER_LESSON_REQUEST_USER_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
            RequestConstants::USER_LESSON_REQUEST_LESSON_ID => 'd3de92e5-ed47-4d49-8811-134c7b293a15',
        ];
        $this->userLessonRequestModel = new UserLessonRequestModel(
            $this->exampleArray[RequestConstants::USER_LESSON_REQUEST_USER_ID],
            $this->exampleArray[RequestConstants::USER_LESSON_REQUEST_LESSON_ID],
        );
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->userLessonRequestModelTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->userLessonRequestModel, $actual);
    }
}
