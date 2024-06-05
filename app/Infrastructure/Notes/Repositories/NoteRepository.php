<?php

namespace App\Infrastructure\Notes\Repositories;

use App\Domain\Notes\Factories\NoteDTOFactoryContract;
use App\Domain\Notes\Repositories\NoteRepositoryContract;
use App\Events\Notes\Models\NoteUpdated;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Infrastructure\Notes\Enums\NotesTagsEnum;
use App\Models\Notes\Note;
use Illuminate\Support\Facades\Cache;

class NoteRepository implements NoteRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    public function save(NoteDTO $dto): bool
    {
        $result = $this->saveDto(new Note, $dto);
        if ($result) {
            NoteUpdated::dispatch();
        }

        return $result;
    }

    public function getByNameAndPeerId(string $name, int $peerId): ?NoteDTO
    {
        return Cache::tags(NotesTagsEnum::NotesRepository->value)->remember(
            $this->formBaseCacheKey($name, $peerId),
            CacheTimeEnum::WEEK->value,
            static function () use ($name, $peerId) {
                $result = Note::query()
                    ->where('name', mb_strtolower(trim($name)))
                    ->where('peer_id', $peerId)
                    ->first();

                if (! $result) {
                    return null;
                }

                /** @var NoteDTOFactoryContract $factory */
                $factory = app(NoteDTOFactoryContract::class);
                return $factory::createFromModel($result);
            }
        );
    }

    public function getByPeerId(string $peerId): array
    {
        return Cache::tags(NotesTagsEnum::NotesRepository->value)->remember(
            $this->formBaseCacheKey($peerId),
            CacheTimeEnum::WEEK,
            static function () use ($peerId) {
                /** @var NoteDTOFactoryContract $factory */
                $factory = app(NoteDTOFactoryContract::class);

                return Note::where('peer_id', $peerId)
                    ->get()
                    ->map(fn ($item) => $factory::createFromModel($item))
                    ->all();
            }
        );
    }
}
