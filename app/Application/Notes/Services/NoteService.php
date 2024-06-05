<?php

namespace App\Application\Notes\Services;

use App\Domain\Notes\Repositories\NoteRepositoryContract;
use App\Domain\Notes\Services\Models\NoteServiceContract;
use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;

final readonly class NoteService implements NoteServiceContract
{
    public function __construct(
        private NoteRepositoryContract $repository,
    ) {
    }

    public function save(NoteDTO $dto): bool
    {
        return $this->repository->save($dto);
    }

    public function getByNameAndPeerId(string $name, int $peerId): ?NoteDTO
    {
        return $this->repository->getByNameAndPeerId($name, $peerId);
    }
}
