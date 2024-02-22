<?php

namespace App\Providers\GroupBoss;

use App\Application\GroupBoss\Services\GroupBossTemplator;
use App\Domain\GroupBoss\Services\GroupBossTemplatorContract;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossTemplatorDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossTemplatorContract::class => GroupBossTemplator::class,
    ];
}
