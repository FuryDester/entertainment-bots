<?php

namespace App\Infrastructure\Commands\Timer\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

final class TimerJobPayloadDTO extends AbstractDTO
{
    protected int $vkUserId;

    protected int $vkPeerId;

    protected int $minutes;

    protected ?string $message;

    public function getVkUserId(): int
    {
        return $this->vkUserId;
    }

    public function setVkUserId(int $vkUserId): TimerJobPayloadDTO
    {
        $this->vkUserId = $vkUserId;
        return $this;
    }

    public function getVkPeerId(): int
    {
        return $this->vkPeerId;
    }

    public function setVkPeerId(int $vkPeerId): TimerJobPayloadDTO
    {
        $this->vkPeerId = $vkPeerId;
        return $this;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes): TimerJobPayloadDTO
    {
        $this->minutes = $minutes;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): TimerJobPayloadDTO
    {
        $this->message = $message;
        return $this;
    }
}
