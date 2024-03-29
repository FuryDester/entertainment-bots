<?php

namespace App\Infrastructure\Common\Enums\Cache;

enum UserCacheEnum: string
{
    case UserRepository = 'user_repository';
    case UserActionRepository = 'user_action_repository';
}
