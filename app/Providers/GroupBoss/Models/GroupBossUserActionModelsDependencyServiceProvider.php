<?php

namespace App\Providers\GroupBoss\Models;

use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossUserActionDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossUserActionModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossUserActionDTOFactoryContract::class => GroupBossUserActionDTOFactory::class,
    ];
}
