<?php

namespace App\Infrastructure\Common\Enums\Cache;

enum CacheTimeEnum: int
{
    case MINUTE = 60;
    case HOUR = 3600;
    case DAY = 86400;
    case WEEK = 604800;
    case MONTH = 2592000;
    case YEAR = 31536000;
}
