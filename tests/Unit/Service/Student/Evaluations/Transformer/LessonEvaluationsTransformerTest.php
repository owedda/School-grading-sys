<?php

namespace Service\Student\Evaluations\Transformer;

use App\Constants\DatabaseConstants;
use App\Constants\RelationshipConstants;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\Model\EvaluationModel;
use App\Service\Shared\DTO\Model\LessonModel;
use App\Service\Shared\DTO\Model\UserLessonModel;
use App\Service\Shared\Transformer\EntityToModel\EvaluationModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\LessonModelTransformer;
use App\Service\Shared\Transformer\EntityToModel\UserLessonModelTransformer;
use App\Service\Student\Evaluations\DTO\Custom\LessonEvaluations;
use App\Service\Student\Evaluations\Transformer\LessonEvaluationsTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;

class LessonEvaluationsTransformerTest extends TestCase
{
    private LessonEvaluationsTransformer $lessonEvaluationsTransformer;
    private LessonEvaluations $lessonEvaluations;
    private array $exampleArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonEvaluationsTransformer = new LessonEvaluationsTransformer();
        $this->lessonEvaluationsTransformer->setLessonTransformer(new LessonModelTransformer());
        $this->lessonEvaluationsTransformer->setUserLessonTransformer(new UserLessonModelTransformer());
        $this->lessonEvaluationsTransformer->setEvaluationTransformer(new EvaluationModelTransformer());

        $this->exampleArray = [
            DatabaseConstants::USER_LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000000',
            DatabaseConstants::USER_LESSONS_TABLE_USER_ID => '00000000-0000-0000-0000-000000000001',
            DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID => '00000000-0000-0000-0000-000000000002',
            RelationshipConstants::USERLESSON_LESSON =>
            [
                DatabaseConstants::LESSONS_TABLE_ID => '00000000-0000-0000-0000-000000000003',
                DatabaseConstants::LESSONS_TABLE_NAME => 'Math',
            ],
            RelationshipConstants::USERLESSON_EVALUATIONS =>
            [
                [
                    DatabaseConstants::EVALUATIONS_TABLE_ID => '00000000-0000-0000-0000-000000000004',
                    DatabaseConstants::EVALUATIONS_TABLE_VALUE => 5,
                    DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-10',
                ],
                [
                    DatabaseConstants::EVALUATIONS_TABLE_ID => '00000000-0000-0000-0000-000000000005',
                    DatabaseConstants::EVALUATIONS_TABLE_VALUE => 6,
                    DatabaseConstants::EVALUATIONS_TABLE_DATE => '2022-10-11',
                ]
            ],
        ];

        $userLessonModel = new UserLessonModel(
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_ID],
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_USER_ID],
            $this->exampleArray[DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID],
        );

        $lessonModel = new LessonModel(
            $this->exampleArray[RelationshipConstants::USERLESSON_LESSON][DatabaseConstants::LESSONS_TABLE_ID],
            $this->exampleArray[RelationshipConstants::USERLESSON_LESSON][DatabaseConstants::LESSONS_TABLE_NAME],
        );

        $evaluations = new DataCollection();
        $evaluations->add(
            new EvaluationModel(
                $this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][0][DatabaseConstants::EVALUATIONS_TABLE_ID],
                $this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][0][DatabaseConstants::EVALUATIONS_TABLE_VALUE],
                new DateTime($this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][0][DatabaseConstants::EVALUATIONS_TABLE_DATE])
            )
        );
        $evaluations->add(
            new EvaluationModel(
                $this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][1][DatabaseConstants::EVALUATIONS_TABLE_ID],
                $this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][1][DatabaseConstants::EVALUATIONS_TABLE_VALUE],
                new DateTime($this->exampleArray[RelationshipConstants::USERLESSON_EVALUATIONS][1][DatabaseConstants::EVALUATIONS_TABLE_DATE])
            )
        );

        $this->lessonEvaluations = new LessonEvaluations($userLessonModel, $lessonModel, $evaluations);
    }

    public function testTransformToObjectWhenCorrect(): void
    {
        $actual = $this->lessonEvaluationsTransformer->transformToObject($this->exampleArray);
        $this->assertEquals($this->lessonEvaluations, $actual);
    }

    public function testTransformToCollection(): void
    {
        $expected = new DataCollection();
        $expected->push($this->lessonEvaluations, $this->lessonEvaluations, $this->lessonEvaluations);

        $manyExampleArrays = [$this->exampleArray, $this->exampleArray, $this->exampleArray];
        $actual = $this->lessonEvaluationsTransformer->transformToCollection($manyExampleArrays);

        $this->assertEquals($expected, $actual);
    }
}
