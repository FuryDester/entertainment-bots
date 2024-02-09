<?php

namespace App\Infrastructure\Common\DataTransferObjects\Models;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class UserDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $vkUserId;

    protected int $vkPeerId;

    protected bool $isAdmin;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getVkUserId(): int
    {
        return $this->vkUserId;
    }

    public function setVkUserId(int $vkUserId): UserDTO
    {
        $this->vkUserId = $vkUserId;
        return $this;
    }

    public function getVkPeerId(): int
    {
        return $this->vkPeerId;
    }

    public function setVkPeerId(int $vkPeerId): UserDTO
    {
        $this->vkPeerId = $vkPeerId;
        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): UserDTO
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): UserDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): UserDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
