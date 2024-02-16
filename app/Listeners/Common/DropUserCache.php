<?php

namespace App\Listeners\Common;

use App\Infrastructure\Common\Enums\Cache\UserCacheEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropUserCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return UserCacheEnum::UserRepository->value;
    }
}
