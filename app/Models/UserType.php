<?php

namespace App\Models;

enum UserType: string
{
    case Teacher = "Teacher";
    case Student = "Student";
    case Admin = "Admin";
}
