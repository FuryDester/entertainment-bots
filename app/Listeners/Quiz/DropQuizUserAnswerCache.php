<?php

namespace App\Listeners\Quiz;

use App\Infrastructure\Quiz\Enums\Cache\QuizTagsEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropQuizUserAnswerCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return QuizTagsEnum::QuizUserAnswerRepository->value;
    }
}
