<?php

namespace App\Domain\Notes\Factories;

use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Models\Notes\Note;
use Illuminate\Support\Carbon;

interface NoteDTOFactoryContract
{
    public static function createFromModel(Note $model): NoteDTO;

    /**
     * @param array{
     *     id: int|null,
     *     user_id: int,
     *     name: string,
     *     text: string,
     *     peer_id: int,
     *     created_at: Carbon|string|null,
     *     updated_at: Carbon|string|null,
     * } $data
     */
    public static function createFromData(array $data): NoteDTO;
}
