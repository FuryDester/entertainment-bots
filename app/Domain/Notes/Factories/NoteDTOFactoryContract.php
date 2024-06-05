<?php

namespace App\Domain\Notes\Factories;

use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Models\Notes\Note;

interface NoteDTOFactoryContract
{
    public static function createFromModel(Note $model): NoteDTO;
}
