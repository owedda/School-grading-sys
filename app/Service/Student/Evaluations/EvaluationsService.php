<?php

declare(strict_types=1);

namespace App\Service\Student\Evaluations;

use App\Constants\DateConstants;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use App\Service\Shared\Collection\DataCollection;
use App\Service\Shared\DTO\RequestModel\DateRequestModel;
use App\Service\Student\Evaluations\DTO\Custom\DateRange;
use App\Service\Student\Evaluations\DTO\Custom\Month;
use App\Service\Student\Evaluations\DTO\ResponseModel\EvaluationsResponseModel;
use App\Service\Student\Evaluations\Facade\ErrorHandler\EvaluationsServiceErrorHandlerInterface;
use App\Service\Student\Evaluations\Facade\Transformers\EvaluationsServiceTransformersInterface;
use App\Service\Student\Evaluations\Filter\DaysFromToFilterInterface;
use App\Service\Teacher\Lessons\DTO\Custom\UserPartial;
use DateTime;

final class EvaluationsService implements EvaluationsServiceInterface
{
    private const FIRST_DAY_OF = 'first day of ';
    private const LAST_DAY_OF = 'last day of ';

    public function __construct(
        private readonly EvaluationsServiceTransformersInterface $transformers,
        private readonly EvaluationsServiceErrorHandlerInterface $errorHandler,
        private readonly UserLessonRepositoryInterface $userLessonRepository,
        private readonly DaysFromToFilterInterface $daysFromToFilter
    ) {
    }

    public function getEvaluationsResponseModel(UserPartial $user, array $date): EvaluationsResponseModel
    {
        $dateRequestModel = $this->transformers->getDateRequestModelTransformer()->transformToObject($date);
        $monthResponseModel = $this->getMonth($dateRequestModel);
        $evaluations = $this->getEvaluations($dateRequestModel, $user);

        return new EvaluationsResponseModel($evaluations, $monthResponseModel, $user->getUsername());
    }

    private function getEvaluations(DateRequestModel $dateRequestModel, UserPartial $user): DataCollection
    {
        $dateRange = $this->getDateRange($dateRequestModel);
        $lessonEvaluationsArray = $this->userLessonRepository->getUserEvaluations($user->getId(), $dateRange);

        $this->errorHandler->handleLessonEvaluations($lessonEvaluationsArray);

        return $this->transformers->getLessonEvaluationsTransformer()->transformToCollection($lessonEvaluationsArray);
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
}
