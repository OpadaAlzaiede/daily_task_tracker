<?php

namespace App\Enums;

enum RecurringTaskUnit: int
{
    case DAY = 1;
    case WEEK = 2;
    case MONTH = 3;
    case YEAR = 4;
}
