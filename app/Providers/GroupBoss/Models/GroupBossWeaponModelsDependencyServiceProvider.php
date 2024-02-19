<?php

namespace App\Providers\GroupBoss\Models;

use App\Domain\GroupBoss\Factories\GroupBossWeaponDTOFactoryContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossWeaponDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossWeaponModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossWeaponDTOFactoryContract::class => GroupBossWeaponDTOFactory::class,
    ];
}
