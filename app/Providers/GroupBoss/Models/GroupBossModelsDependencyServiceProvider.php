<?php

namespace App\Providers\GroupBoss\Models;

use App\Domain\GroupBoss\Factories\GroupBossDTOFactoryContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossDTOFactoryContract::class => GroupBossDTOFactory::class,
    ];
}
