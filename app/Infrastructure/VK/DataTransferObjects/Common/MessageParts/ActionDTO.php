<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\MessageParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;
use App\Infrastructure\VK\Enums\MessageEventTypeEnum;

final class ActionDTO extends BaseDTO
{
    protected MessageEventTypeEnum $type;

    protected ?int $memberId;

    protected ?string $text;

    protected ?string $email;

    protected ?PhotoDTO $photo;

    public function getType(): MessageEventTypeEnum
    {
        return $this->type;
    }

    public function setType(MessageEventTypeEnum $type): ActionDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getMemberId(): ?int
    {
        return $this->memberId;
    }

    public function setMemberId(?int $memberId): ActionDTO
    {
        $this->memberId = $memberId;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): ActionDTO
    {
        $this->text = $text;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): ActionDTO
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoto(): ?PhotoDTO
    {
        return $this->photo;
    }

    public function setPhoto(?PhotoDTO $photo): ActionDTO
    {
        $this->photo = $photo;
        return $this;
    }
}
