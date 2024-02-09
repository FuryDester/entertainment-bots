<?php

namespace App\Infrastructure\VK\DataTransferObjects\Models;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class VkEventDTO extends AbstractDTO
{
    protected ?int $id;

    protected string $eventId;

    protected string $type;

    protected string $version;

    protected int $groupId;

    protected string $object;

    protected bool $isProcessed = false;

    protected int $attempts = 1;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): VkEventDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function setEventId(string $eventId): VkEventDTO
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): VkEventDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): VkEventDTO
    {
        $this->version = $version;
        return $this;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): VkEventDTO
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function setObject(string $object): VkEventDTO
    {
        $this->object = $object;
        return $this;
    }

    public function isProcessed(): bool
    {
        return $this->isProcessed;
    }

    public function setIsProcessed(bool $isProcessed): VkEventDTO
    {
        $this->isProcessed = $isProcessed;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): VkEventDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): VkEventDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function setAttempts(int $attempts): VkEventDTO
    {
        $this->attempts = $attempts;
        return $this;
    }
}
