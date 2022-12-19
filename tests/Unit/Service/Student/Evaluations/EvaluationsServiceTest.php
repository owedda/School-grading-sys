<?php

namespace Service\Student\Evaluations;

use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Exception\ValidatorException;
use App\Service\Student\Evaluations\EvaluationsService;
use App\Service\Student\Evaluations\Facade\ErrorHandler\EvaluationsServiceErrorHandlerInterface;
use App\Service\Student\Evaluations\Facade\Transformers\EvaluationsServiceTransformersInterface;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;
use DateTime;
use PHPUnit\Framework\TestCase;

class EvaluationsServiceTest extends TestCase
{
    private EvaluationsService $service;
    private EvaluationsServiceTransformersInterface $transformers;
    private EvaluationsServiceErrorHandlerInterface $errorHandler;
    private UserLessonRepositoryInterface $userLessonRepository;
    private DaysFromToFilterInterface $daysFromToFilter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformers = $this->createMock(EvaluationsServiceTransformersInterface::class);
        $this->errorHandler = $this->createMock(EvaluationsServiceErrorHandlerInterface::class);
        $this->userLessonRepository = $this->createMock(UserLessonRepositoryInterface::class);
        $this->daysFromToFilter = $this->createMock(DaysFromToFilterInterface::class);

        $this->service = new EvaluationsService(
            $this->transformers,
            $this->errorHandler,
            $this->userLessonRepository,
            $this->daysFromToFilter
        );
    }

}
