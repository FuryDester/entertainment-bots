<?php

namespace App\Providers\GroupBoss\Models;

use App\Application\GroupBoss\Services\Models\GroupBossUserActionService;
use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossUserActionRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossUserActionServiceContract;
use App\Infrastructure\GroupBoss\Factories\GroupBossUserActionDTOFactory;
use App\Infrastructure\GroupBoss\Repositories\GroupBossUserActionRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class GroupBossUserActionModelsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        GroupBossUserActionDTOFactoryContract::class => GroupBossUserActionDTOFactory::class,
        GroupBossUserActionServiceContract::class => GroupBossUserActionService::class,
        GroupBossUserActionRepositoryContract::class => GroupBossUserActionRepository::class,
    ];
}
