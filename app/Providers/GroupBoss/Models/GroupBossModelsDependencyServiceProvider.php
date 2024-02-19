<?php

namespace App\Providers\GroupBoss\Models;

use App\Application\GroupBoss\Services\Models\GroupBossService;
use App\Domain\GroupBoss\Factories\GroupBossDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossServiceContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossDTOFactory;
use App\Infrastructure\GroupBoss\Repositories\GroupBossRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossDTOFactoryContract::class => GroupBossDTOFactory::class,
        GroupBossServiceContract::class => GroupBossService::class,
        GroupBossRepositoryContract::class => GroupBossRepository::class,
    ];
}
