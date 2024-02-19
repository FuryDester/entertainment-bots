<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\CommentParts;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

final class DonutDTO extends AbstractDTO
{
    protected bool $isDon;

    protected string $placeholder;

    public function isDon(): bool
    {
        return $this->isDon;
    }

    public function setIsDon(bool $isDon): DonutDTO
    {
        $this->isDon = $isDon;
        return $this;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function setPlaceholder(string $placeholder): DonutDTO
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
