<?php

namespace App\Providers\GroupBoss;

use App\Application\GroupBoss\Services\GroupBossActionProcessorService;
use App\Domain\GroupBoss\Services\GroupBossActionProcessorServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossActionProcessorDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossActionProcessorServiceContract::class => GroupBossActionProcessorService::class,
    ];
}
