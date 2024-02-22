<?php

namespace App\Domain\GroupBoss\Repositories;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;

interface GroupBossWeaponRepositoryContract
{
    public function getWeaponByNameAndBoss(GroupBossDTO $boss, string $name): ?GroupBossWeaponDTO;
}
