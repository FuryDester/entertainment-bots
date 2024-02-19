<?php

namespace App\Infrastructure\GroupBoss\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class GroupBossWeaponDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $groupBossId;

    protected string $name;

    protected ?string $hitDamageTemplate;

    protected int $minDamage;

    protected int $maxDamage;

    protected int $hitChance;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): GroupBossWeaponDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getGroupBossId(): int
    {
        return $this->groupBossId;
    }

    public function setGroupBossId(int $groupBossId): GroupBossWeaponDTO
    {
        $this->groupBossId = $groupBossId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): GroupBossWeaponDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getHitDamageTemplate(): ?string
    {
        return $this->hitDamageTemplate;
    }

    public function setHitDamageTemplate(?string $hitDamageTemplate): GroupBossWeaponDTO
    {
        $this->hitDamageTemplate = $hitDamageTemplate;
        return $this;
    }

    public function getMinDamage(): int
    {
        return $this->minDamage;
    }

    public function setMinDamage(int $minDamage): GroupBossWeaponDTO
    {
        $this->minDamage = $minDamage;
        return $this;
    }

    public function getMaxDamage(): int
    {
        return $this->maxDamage;
    }

    public function setMaxDamage(int $maxDamage): GroupBossWeaponDTO
    {
        $this->maxDamage = $maxDamage;
        return $this;
    }

    public function getHitChance(): int
    {
        return $this->hitChance;
    }

    public function setHitChance(int $hitChance): GroupBossWeaponDTO
    {
        $this->hitChance = $hitChance;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): GroupBossWeaponDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): GroupBossWeaponDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
