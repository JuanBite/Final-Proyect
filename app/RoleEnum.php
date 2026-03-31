<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'ADMIN';
    case INSTRUCTOR = 'INSTRUCTOR';
    case STUDENT = 'STUDENT';
}
