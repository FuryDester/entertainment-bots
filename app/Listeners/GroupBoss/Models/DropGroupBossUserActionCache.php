<?php

namespace App\Listeners\GroupBoss\Models;

use App\Infrastructure\GroupBoss\Enums\GroupBossTagsEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropGroupBossUserActionCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return GroupBossTagsEnum::GroupBossUserActionRepository->value;
    }
}
