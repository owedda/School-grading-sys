<?php

declare(strict_types=1);

namespace App\Service\Teacher\Students\Facade\ErrorHandler;

use App\Service\Shared\Exception\ValidatorException;
use App\Service\Shared\Validator\Model\ValidatorInterface;
use App\Service\Teacher\Students\Validator\UserAttendedLessonResponseModelValidatorInterface;
use Psr\Log\LoggerInterface;

final class StudentsServiceErrorHandler implements StudentsServiceErrorHandlerInterface
{
    private ValidatorInterface $userModelValidator;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly UserAttendedLessonResponseModelValidatorInterface $userAttendedLessonResponseModelValidator
    ) {
    }

    public function handleUsers(array $users): void
    {
        try {
            $this->userModelValidator->validateMany($users);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function handleUser(array $user): void
    {
        try {
            $this->userModelValidator->validateMany($user);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function handleUserAttendedLessons(array $userAttendedLessons): void
    {
        try {
            $this->userAttendedLessonResponseModelValidator->validate($userAttendedLessons);
        } catch (ValidatorException $exception) {
            $this->logger->error($exception);
        }
    }

    public function setUserModelValidator(ValidatorInterface $userModelValidator): void
    {
        $this->userModelValidator = $userModelValidator;
    }
}
