<?php

namespace App\Listeners\Quiz;

use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropQuizUserAnswerCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return QuizEnum::QuizUserAnswerRepository->value;
    }
}
