<?php

namespace App\Infrastructure\GroupBoss\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class GroupBossDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $userId;

    protected int $postId;

    protected string $name;

    protected string $postContent;

    protected ?string $image;

    protected int $maxHealth;

    protected int $currentHealth;

    protected int $baseHitChance;

    protected int $hitCooldown;

    protected int $missCooldown;

    protected ?int $killedBy;

    protected ?Carbon $killedAt;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): GroupBossDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): GroupBossDTO
    {
        $this->userId = $userId;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): GroupBossDTO
    {
        $this->name = $name;

        return $this;
    }

    public function getPostContent(): string
    {
        return $this->postContent;
    }

    public function setPostContent(string $postContent): GroupBossDTO
    {
        $this->postContent = $postContent;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): GroupBossDTO
    {
        $this->image = $image;

        return $this;
    }

    public function getMaxHealth(): int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(int $maxHealth): GroupBossDTO
    {
        $this->maxHealth = $maxHealth;

        return $this;
    }

    public function getCurrentHealth(): int
    {
        return $this->currentHealth;
    }

    public function setCurrentHealth(int $currentHealth): GroupBossDTO
    {
        $this->currentHealth = $currentHealth;

        return $this;
    }

    public function getBaseHitChance(): int
    {
        return $this->baseHitChance;
    }

    public function setBaseHitChance(int $baseHitChance): GroupBossDTO
    {
        $this->baseHitChance = $baseHitChance;

        return $this;
    }

    public function getHitCooldown(): int
    {
        return $this->hitCooldown;
    }

    public function setHitCooldown(int $hitCooldown): GroupBossDTO
    {
        $this->hitCooldown = $hitCooldown;

        return $this;
    }

    public function getMissCooldown(): int
    {
        return $this->missCooldown;
    }

    public function setMissCooldown(int $missCooldown): GroupBossDTO
    {
        $this->missCooldown = $missCooldown;

        return $this;
    }

    public function getKilledBy(): ?int
    {
        return $this->killedBy;
    }

    public function setKilledBy(?int $killedBy): GroupBossDTO
    {
        $this->killedBy = $killedBy;

        return $this;
    }

    public function getKilledAt(): ?Carbon
    {
        return $this->killedAt;
    }

    public function setKilledAt(?Carbon $killedAt): GroupBossDTO
    {
        $this->killedAt = $killedAt;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): GroupBossDTO
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): GroupBossDTO
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): GroupBossDTO
    {
        $this->postId = $postId;

        return $this;
    }
}
