<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\MessageParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

final class ForwardMessageDTO extends BaseDTO
{
    protected int $date;

    protected int $fromId;

    protected int $id;

    protected int $peerId;

    protected ?string $text;

    protected int $conversationMessageId;

    /** @var object[] */
    protected array $attachments;

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): ForwardMessageDTO
    {
        $this->date = $date;
        return $this;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setFromId(int $fromId): ForwardMessageDTO
    {
        $this->fromId = $fromId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ForwardMessageDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getPeerId(): int
    {
        return $this->peerId;
    }

    public function setPeerId(int $peerId): ForwardMessageDTO
    {
        $this->peerId = $peerId;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): ForwardMessageDTO
    {
        $this->text = $text;
        return $this;
    }

    public function getConversationMessageId(): int
    {
        return $this->conversationMessageId;
    }

    public function setConversationMessageId(int $conversationMessageId): ForwardMessageDTO
    {
        $this->conversationMessageId = $conversationMessageId;
        return $this;
    }

    /**
     * @return object[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param object[] $attachments
     */
    public function setAttachments(array $attachments): ForwardMessageDTO
    {
        $this->attachments = $attachments;
        return $this;
    }
}
