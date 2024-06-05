<?php

namespace App\Infrastructure\Notes\Factories;

use App\Domain\Notes\Factories\NoteDTOFactoryContract;
use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Models\Notes\Note;

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
}
