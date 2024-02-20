<?php

namespace App\Listeners\Common;

use App\Infrastructure\Common\Enums\Cache\UserCacheEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropUserActionCache extends AbstractCacheFlushListener
{
    /**
     * @inheritDoc
     */
    protected function getCacheTag(): string|array
    {
        return UserCacheEnum::UserActionRepository->value;
    }
}
