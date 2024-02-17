<?php

namespace App\Infrastructure\VK\DataTransferObjects\Requests;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

final class CallbackRequestDTO extends AbstractDTO
{
    protected string $type;

    protected string $eventId;

    protected string $version;

    protected array $object;

    protected int $groupId;

    protected ?string $secret;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): CallbackRequestDTO
    {
        $this->type = $type;

        return $this;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function setEventId(string $eventId): CallbackRequestDTO
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function getObject(): array
    {
        return $this->object;
    }

    public function setObject(array $object): CallbackRequestDTO
    {
        $this->object = $object;

        return $this;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): CallbackRequestDTO
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(?string $secret): CallbackRequestDTO
    {
        $this->secret = $secret;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): CallbackRequestDTO
    {
        $this->version = $version;

        return $this;
    }
}
