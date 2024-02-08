<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

abstract class AbstractCacheFlushListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        $cacheTags = is_array($this->getCacheTag())
            ? implode(', ', $this->getCacheTag())
            : $this->getCacheTag();

        Cache::tags($cacheTags)->flush();
        Log::info('Flushed cache by tags (event updated): ' . $cacheTags);
    }

    /**
     * Функция возвращает теги для очистки кеша по ним.
     *
     * @return string|string[]
     */
    abstract protected function getCacheTag(): string|array;
}
