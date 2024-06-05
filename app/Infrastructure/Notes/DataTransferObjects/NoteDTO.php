<?php

namespace App\Infrastructure\Notes\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

class NoteDTO extends AbstractDTO
{
    protected int $userId;

    protected string $text;

    protected int $peerId;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): NoteDTO
    {
        $this->userId = $userId;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): NoteDTO
    {
        $this->text = $text;
        return $this;
    }

    public function getPeerId(): int
    {
        return $this->peerId;
    }

    public function setPeerId(int $peerId): NoteDTO
    {
        $this->peerId = $peerId;
        return $this;
    }
}
