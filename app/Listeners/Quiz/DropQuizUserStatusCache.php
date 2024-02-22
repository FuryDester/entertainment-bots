<?php

namespace App\Listeners\Quiz;

use App\Infrastructure\Quiz\Enums\Cache\QuizTagsEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropQuizUserStatusCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return QuizTagsEnum::QuizUserStatusesRepository->value;
    }
}
