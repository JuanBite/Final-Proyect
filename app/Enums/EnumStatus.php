<?php

namespace App\Enums;

enum EnumStatus: string
{
    case IN_PROGRESS = 'IN_PROGRESS';
    case COMPLETED = 'COMPLETED';
    case DELAYED = 'DELAYED';
}

