<?php

namespace App\Listeners\Vk;

use App\Infrastructure\VK\Enums\Cache\VkCacheEnum;
use App\Listeners\AbstractCacheFlushListener;
use Illuminate\Support\Facades\Cache;

final class DropVkEventCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): array|string
    {
        return VkCacheEnum::VkEventRepository->value;
    }
}
