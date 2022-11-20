<?php

namespace App\Models;

enum UserTypeEnum: string
{
    case Teacher = "Teacher";
    case Student = "Student";
    case Admin = "Admin";
}
