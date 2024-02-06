<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\MessageParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoDTO;

final class MessageDTO extends BaseDTO
{
    protected int $id;

    protected int $conversationMessageId;

    protected int $out;

    protected int $peerId;

    protected int $fromId;

    protected ?string $text;

    protected int $date;

    protected ?int $updateTime;

    protected int $randomId;

    protected ?string $ref;

    protected ?string $refSource;

    /** @var object[] */
    protected array $attachments;

    protected bool $important;

    protected ?string $payload;

    protected ?ForwardMessageDTO $replyMessage;

    /** @var ForwardMessageDTO[]|null */
    protected ?array $fwdMessages;

    protected ?ActionDTO $action;

    protected ?int $adminAuthorId;

    protected ?bool $isCropped;

    protected ?int $membersCount;

    protected ?bool $wasListened;

    protected ?int $pinnedAt;

    protected ?string $messageTag;

    protected ?bool $isExpired;

    protected ?GeoDTO $geo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): MessageDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getConversationMessageId(): int
    {
        return $this->conversationMessageId;
    }

    public function setConversationMessageId(int $conversationMessageId): MessageDTO
    {
        $this->conversationMessageId = $conversationMessageId;
        return $this;
    }

    public function getOut(): int
    {
        return $this->out;
    }

    public function setOut(int $out): MessageDTO
    {
        $this->out = $out;
        return $this;
    }

    public function getPeerId(): int
    {
        return $this->peerId;
    }

    public function setPeerId(int $peerId): MessageDTO
    {
        $this->peerId = $peerId;
        return $this;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setFromId(int $fromId): MessageDTO
    {
        $this->fromId = $fromId;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): MessageDTO
    {
        $this->text = $text;
        return $this;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): MessageDTO
    {
        $this->date = $date;
        return $this;
    }

    public function getUpdateTime(): ?int
    {
        return $this->updateTime;
    }

    public function setUpdateTime(?int $updateTime): MessageDTO
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    public function getRandomId(): int
    {
        return $this->randomId;
    }

    public function setRandomId(int $randomId): MessageDTO
    {
        $this->randomId = $randomId;
        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): MessageDTO
    {
        $this->ref = $ref;
        return $this;
    }

    public function getRefSource(): ?string
    {
        return $this->refSource;
    }

    public function setRefSource(?string $refSource): MessageDTO
    {
        $this->refSource = $refSource;
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
    public function setAttachments(array $attachments): MessageDTO
    {
        $this->attachments = $attachments;
        return $this;
    }

    public function isImportant(): bool
    {
        return $this->important;
    }

    public function setImportant(bool $important): MessageDTO
    {
        $this->important = $important;
        return $this;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function setPayload(?string $payload): MessageDTO
    {
        $this->payload = $payload;
        return $this;
    }

    public function getReplyMessage(): ?ForwardMessageDTO
    {
        return $this->replyMessage;
    }

    public function setReplyMessage(?ForwardMessageDTO $replyMessage): MessageDTO
    {
        $this->replyMessage = $replyMessage;
        return $this;
    }

    /**
     * @return ForwardMessageDTO[]|null
     */
    public function getFwdMessages(): ?array
    {
        return $this->fwdMessages;
    }

    /**
     * @param ForwardMessageDTO[]|null $fwdMessages
     */
    public function setFwdMessages(?array $fwdMessages): MessageDTO
    {
        $this->fwdMessages = $fwdMessages;
        return $this;
    }

    public function getAction(): ?ActionDTO
    {
        return $this->action;
    }

    public function setAction(?ActionDTO $action): MessageDTO
    {
        $this->action = $action;
        return $this;
    }

    public function getAdminAuthorId(): ?int
    {
        return $this->adminAuthorId;
    }

    public function setAdminAuthorId(?int $adminAuthorId): MessageDTO
    {
        $this->adminAuthorId = $adminAuthorId;
        return $this;
    }

    public function getIsCropped(): ?bool
    {
        return $this->isCropped;
    }

    public function setIsCropped(?bool $isCropped): MessageDTO
    {
        $this->isCropped = $isCropped;
        return $this;
    }

    public function getMembersCount(): ?int
    {
        return $this->membersCount;
    }

    public function setMembersCount(?int $membersCount): MessageDTO
    {
        $this->membersCount = $membersCount;
        return $this;
    }

    public function getWasListened(): ?bool
    {
        return $this->wasListened;
    }

    public function setWasListened(?bool $wasListened): MessageDTO
    {
        $this->wasListened = $wasListened;
        return $this;
    }

    public function getPinnedAt(): ?int
    {
        return $this->pinnedAt;
    }

    public function setPinnedAt(?int $pinnedAt): MessageDTO
    {
        $this->pinnedAt = $pinnedAt;
        return $this;
    }

    public function getMessageTag(): ?string
    {
        return $this->messageTag;
    }

    public function setMessageTag(?string $messageTag): MessageDTO
    {
        $this->messageTag = $messageTag;
        return $this;
    }

    public function getIsExpired(): ?bool
    {
        return $this->isExpired;
    }

    public function setIsExpired(?bool $isExpired): MessageDTO
    {
        $this->isExpired = $isExpired;
        return $this;
    }

    public function getGeo(): ?GeoDTO
    {
        return $this->geo;
    }

    public function setGeo(?GeoDTO $geo): MessageDTO
    {
        $this->geo = $geo;
        return $this;
    }
}
