<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\DonutDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\ThreadDTO;

final class CommentDTO extends AbstractDTO
{
    protected int $id;

    protected int $fromId;

    protected int $date;

    protected ?string $text;

    protected int $ownerId;

    protected ?DonutDTO $donut;

    protected ?int $replyToUser;

    protected ?int $replyToComment;

    /** @var object[] */
    protected array $attachments;

    /** @var int[] */
    protected array $parentsStack;

    protected ?ThreadDTO $thread;

    protected int $postId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CommentDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setFromId(int $fromId): CommentDTO
    {
        $this->fromId = $fromId;

        return $this;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): CommentDTO
    {
        $this->date = $date;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): CommentDTO
    {
        $this->text = $text;

        return $this;
    }

    public function getDonut(): ?DonutDTO
    {
        return $this->donut;
    }

    public function setDonut(?DonutDTO $donut): CommentDTO
    {
        $this->donut = $donut;

        return $this;
    }

    public function getReplyToUser(): ?int
    {
        return $this->replyToUser;
    }

    public function setReplyToUser(?int $replyToUser): CommentDTO
    {
        $this->replyToUser = $replyToUser;

        return $this;
    }

    public function getReplyToComment(): ?int
    {
        return $this->replyToComment;
    }

    public function setReplyToComment(?int $replyToComment): CommentDTO
    {
        $this->replyToComment = $replyToComment;

        return $this;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function setAttachments(array $attachments): CommentDTO
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function getParentsStack(): array
    {
        return $this->parentsStack;
    }

    public function setParentsStack(array $parentsStack): CommentDTO
    {
        $this->parentsStack = $parentsStack;

        return $this;
    }

    public function getThread(): ?ThreadDTO
    {
        return $this->thread;
    }

    public function setThread(?ThreadDTO $thread): CommentDTO
    {
        $this->thread = $thread;

        return $this;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): CommentDTO
    {
        $this->postId = $postId;

        return $this;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function setOwnerId(int $ownerId): CommentDTO
    {
        $this->ownerId = $ownerId;

        return $this;
    }
}
