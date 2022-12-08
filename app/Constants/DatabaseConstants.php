<?php

declare(strict_types=1);

namespace App\Constants;

final class DatabaseConstants
{
    public const USERS_TABLE = 'users';
    public const USERS_TABLE_ID = 'id';
    public const USERS_TABLE_USERNAME = 'username';
    public const USERS_TABLE_NAME = 'name';
    public const USERS_TABLE_LAST_NAME = 'last_name';
    public const USERS_TABLE_TYPE = 'type';
    public const USERS_TABLE_EMAIL = 'email';
    public const USERS_TABLE_PASSWORD = 'password';
    public const USERS_TABLE_REMEMBER_TOKEN = 'remember_token';

    public const EVALUATIONS_TABLE = 'evaluations';
    public const EVALUATIONS_TABLE_ID = 'id';
    public const EVALUATIONS_TABLE_VALUE = 'value';
    public const EVALUATIONS_TABLE_USER_LESSON_ID = 'user_lesson_id';
    public const EVALUATIONS_TABLE_DATE = 'date';

    public const LESSONS_TABLE = 'lessons';
    public const LESSONS_TABLE_ID = 'id';
    public const LESSONS_TABLE_NAME = 'name';

    public const USER_LESSONS_TABLE = 'user_lessons';
    public const USER_LESSONS_TABLE_ID = 'id';
    public const USER_LESSONS_TABLE_USER_ID = 'user_id';
    public const USER_LESSONS_TABLE_LESSON_ID = 'lesson_id';
}
