<?php

namespace App\Listeners\Notes;

use App\Infrastructure\Notes\Enums\NotesTagsEnum;
use App\Listeners\AbstractCacheFlushListener;

final class DropNotesCache extends AbstractCacheFlushListener
{
    /**
     * {@inheritDoc}
     */
    protected function getCacheTag(): string|array
    {
        return NotesTagsEnum::NotesRepository->value;
    }
}
