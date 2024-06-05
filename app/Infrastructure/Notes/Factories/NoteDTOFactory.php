<?php

namespace App\Infrastructure\Notes\Factories;

use App\Domain\Notes\Factories\NoteDTOFactoryContract;
use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Models\Notes\Note;
use Illuminate\Support\Carbon;

final readonly class NoteDTOFactory implements NoteDTOFactoryContract
{
    public static function createFromModel(Note $model): NoteDTO
    {
        return (new NoteDTO)
            ->setUserId($model->user_id)
            ->setText($model->text)
            ->setName($model->name)
            ->setPeerId($model->peer_id)
            ->setId($model->id)
            ->setCreatedAt($model->created_at)
            ->setUpdatedAt($model->updated_at);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): NoteDTO
    {
        return (new NoteDTO)
            ->setName($data['name'])
            ->setId($data['id'] ?? null)
            ->setText($data['text'])
            ->setPeerId($data['peer_id'])
            ->setUserId($data['user_id'])
            ->setCreatedAt(($data['created_at'] ?? null) ? (new Carbon($data['created_at'])) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? (new Carbon($data['updated_at'])) : null);
    }
}
