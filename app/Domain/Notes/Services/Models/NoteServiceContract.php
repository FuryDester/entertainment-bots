<?php

namespace App\Domain\Notes\Services\Models;

use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;

interface NoteServiceContract
{
    public function save(NoteDTO $dto): bool;

    public function getByNameAndPeerId(string $name, int $peerId): ?NoteDTO;

    /**
     * @return NoteDTO[]
     */
    public function getByPeerId(int $peerId): array;
}
