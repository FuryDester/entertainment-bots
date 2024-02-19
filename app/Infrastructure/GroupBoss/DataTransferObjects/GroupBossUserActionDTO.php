<?php

namespace App\Infrastructure\GroupBoss\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class GroupBossUserActionDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $userId;

    protected int $groupBossId;

    protected int $groupBossWeaponId;

    protected int $damage;

    protected bool $isMiss = false;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): GroupBossUserActionDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): GroupBossUserActionDTO
    {
        $this->userId = $userId;
        return $this;
    }

    public function getGroupBossId(): int
    {
        return $this->groupBossId;
    }

    public function setGroupBossId(int $groupBossId): GroupBossUserActionDTO
    {
        $this->groupBossId = $groupBossId;
        return $this;
    }

    public function getGroupBossWeaponId(): int
    {
        return $this->groupBossWeaponId;
    }

    public function setGroupBossWeaponId(int $groupBossWeaponId): GroupBossUserActionDTO
    {
        $this->groupBossWeaponId = $groupBossWeaponId;
        return $this;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): GroupBossUserActionDTO
    {
        $this->damage = $damage;
        return $this;
    }

    public function isMiss(): bool
    {
        return $this->isMiss;
    }

    public function setIsMiss(bool $isMiss): GroupBossUserActionDTO
    {
        $this->isMiss = $isMiss;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): GroupBossUserActionDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): GroupBossUserActionDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
