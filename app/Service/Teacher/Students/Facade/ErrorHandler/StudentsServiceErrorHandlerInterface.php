<?php

namespace App\Service\Teacher\Students\Facade\ErrorHandler;

use App\Service\Shared\Validator\Model\ValidatorInterface;

interface StudentsServiceErrorHandlerInterface
{
    public function handleUsers(array $users): void;

    public function handleUser(array $user): void;

    public function handleUserAttendedLessons(array $userAttendedLessons): void;

    public function setUserModelValidator(ValidatorInterface $userModelValidator): void;
}
