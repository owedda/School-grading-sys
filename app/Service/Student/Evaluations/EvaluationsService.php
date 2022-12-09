<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations;

use App\Constants\DateConstants;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collections\DataCollection;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Shared\Transformers\RequestModel\RequestModelTransformerInterface;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;
use App\Service\Student\Evaluations\DTO\Custom\Month;
use App\Service\Student\Evaluations\DTO\ResponseModel\EvaluationsResponseModel;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Student\Evaluations\Transformers\LessonEvaluationsTransformerInterface;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;
use DateTime;

final class EvaluationsService implements EvaluationsServiceInterface
{
    private const FIRST_DAY_OF = 'first day of ';
    private const LAST_DAY_OF = 'last day of ';
    private RequestModelTransformerInterface $dateRequestModelTransformer;

    public function __construct(
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly DaysFromToFilterInterface $daysFromToFilter,
        private readonly LessonEvaluationsTransformerInterface $lessonEvaluationsTransformer
    ) {
    }

    public function getEvaluationsResponseModel(UserPartial $user, array $date): EvaluationsResponseModel
    {
        $dateRequestModel = $this->dateRequestModelTransformer->transformArrayToObject($date);
        $monthResponseModel = $this->getMonth($dateRequestModel);
        $evaluations = $this->getEvaluations($dateRequestModel, $user);

        return new EvaluationsResponseModel($evaluations, $monthResponseModel, $user->getUsername());
    }

    private function getEvaluations(DateRequestModel $dateRequestModel, UserPartial $user): DataCollection
    {
        $dateRange = $this->getDateRange($dateRequestModel);
        $lessonEvaluationResponseModel = $this->userLessonRepository->getUserEvaluations($user->getId(), $dateRange);

        return $this->lessonEvaluationsTransformer->transformArrayToCollection($lessonEvaluationResponseModel);
    }

    private function getMonth(DateRequestModel $dateRequestModel): Month
    {
        return new Month($dateRequestModel->getDate(), $this->filterAllMonthDays($dateRequestModel));
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

    public function setDateRequestModelTransformer(RequestModelTransformerInterface $dateRequestModelTransformer): void
    {
        $this->dateRequestModelTransformer = $dateRequestModelTransformer;
    }
}
