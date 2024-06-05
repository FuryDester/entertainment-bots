<?php

namespace App\Infrastructure\Notes\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

class NoteDTO extends AbstractDTO
{
    protected ?int $id = null;

    protected int $userId;

    protected string $name;

    protected string $text;

    protected int $peerId;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): NoteDTO
    {
        $this->name = mb_strtolower($name);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): NoteDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): NoteDTO
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): NoteDTO
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
