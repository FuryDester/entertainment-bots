<?php

namespace App\Domain\Notes\Repositories;

use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;

interface NoteRepositoryContract
{
    public function save(NoteDTO $dto): bool;

    public function getByNameAndPeerId(string $name, int $peerId): ?NoteDTO;

    /**
     * @param string $peerId
     * @return NoteDTO[]
     */
    public function getByPeerId(string $peerId): array;
}
