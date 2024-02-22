<?php

namespace App\Providers\GroupBoss\Models;

use App\Application\GroupBoss\Services\Models\GroupBossWeaponService;
use App\Domain\GroupBoss\Factories\GroupBossWeaponDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossWeaponRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossWeaponServiceContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossWeaponDTOFactory;
use App\Infrastructure\GroupBoss\Repositories\GroupBossWeaponRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossWeaponModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossWeaponDTOFactoryContract::class => GroupBossWeaponDTOFactory::class,
        GroupBossWeaponRepositoryContract::class => GroupBossWeaponRepository::class,
        GroupBossWeaponServiceContract::class => GroupBossWeaponService::class,
    ];
}
