<?php

namespace App\Providers\GroupBoss;

use App\Application\GroupBoss\Services\GroupBossExecutor;
use App\Domain\GroupBoss\Services\GroupBossExecutorContract;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossExecutorDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossExecutorContract::class => GroupBossExecutor::class,
    ];
}
