<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations;

use App\Constants\DateConstants;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Grading\Collections\DataCollection;
use App\Service\Grading\Filter\DaysFromToFilterInterface;
use App\Service\Grading\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Grading\ValueObjects\Custom\DateRange;
use App\Service\Grading\ValueObjects\RequestModel\DateRequestModel;
use App\Service\Grading\ValueObjects\ResponseModel\MonthResponseModel;
use DateTime;

final class EvaluationsService implements EvaluationsServiceInterface
{
    private const FIRST_DAY_OF = 'first day of ';
    private const LAST_DAY_OF = 'last day of ';
    private RequestModelTransformerInterface $dateRequestModelTransformer;

    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly DaysFromToFilterInterface $daysFromToFilter
    ) {
    }

    public function getUserEvaluations(string $userId, DateRequestModel $dateRequestModel): DataCollection
    {
        $dateRange = $this->getDateRange($dateRequestModel);

        return $this->userLessonRepository->getUserEvaluations($userId, $dateRange);
    }

    public function getMonth(DateRequestModel $dateRequestModel): MonthResponseModel
    {
        return new MonthResponseModel($dateRequestModel->getDate(), $this->filterAllMonthDays($dateRequestModel));
    }

    private function filterAllMonthDays(DateRequestModel $dateRequestModel): DataCollection
    {
        return $this->daysFromToFilter->filter($this->getDateRange($dateRequestModel));
    }

    private function getDateRange(DateRequestModel $dateRequestModel): DateRange
    {
        return new DateRange(
            new DateTime(self::FIRST_DAY_OF . $dateRequestModel->getDate()->format(DateConstants::DATE_FORMAT_FULL)),
            new DateTime(self::LAST_DAY_OF . $dateRequestModel->getDate()->format(DateConstants::DATE_FORMAT_FULL))
        );
    }

    public function getDateRequestModelTransformer(): RequestModelTransformerInterface
    {
        return $this->dateRequestModelTransformer;
    }

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }
}
