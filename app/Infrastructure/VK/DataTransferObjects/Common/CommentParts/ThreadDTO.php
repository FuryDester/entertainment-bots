<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\CommentParts;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

final class ThreadDTO extends AbstractDTO
{
    protected int $count;

    protected ?array $items = null;

    protected ?bool $canPost;

    protected ?bool $showReplyButton;

    protected ?bool $groupsCanPost;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): ThreadDTO
    {
        $this->count = $count;
        return $this;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function setItems(?array $items): ThreadDTO
    {
        $this->items = $items;
        return $this;
    }

    public function getCanPost(): ?bool
    {
        return $this->canPost;
    }

    public function setCanPost(?bool $canPost): ThreadDTO
    {
        $this->canPost = $canPost;
        return $this;
    }

    public function getShowReplyButton(): ?bool
    {
        return $this->showReplyButton;
    }

    public function setShowReplyButton(?bool $showReplyButton): ThreadDTO
    {
        $this->showReplyButton = $showReplyButton;
        return $this;
    }

    public function getGroupsCanPost(): ?bool
    {
        return $this->groupsCanPost;
    }

    public function setGroupsCanPost(?bool $groupsCanPost): ThreadDTO
    {
        $this->groupsCanPost = $groupsCanPost;
        return $this;
    }
}
