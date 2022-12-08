<?php

declare(strict_types=1);

namespace App\Constants;

final class RequestConstants
{
    public const USER_REQUEST_USERNAME = 'username';
    public const USER_REQUEST_NAME = 'name';
    public const USER_REQUEST_LAST_NAME = 'last-name';
    public const USER_REQUEST_EMAIL = 'email';
    public const USER_REQUEST_PASSWORD = 'password';

    public const EVALUATION_REQUEST_VALUE = 'value';
    public const EVALUATION_REQUEST_USER_LESSON_ID = 'user-lesson-id';
    public const EVALUATION_REQUEST_DATE = 'date';

    public const USER_LESSON_REQUEST_USER_ID = 'user-id';
    public const USER_LESSON_REQUEST_LESSON_ID = 'lesson-id';

    public const DATE_REQUEST_DATE = 'date';
}
