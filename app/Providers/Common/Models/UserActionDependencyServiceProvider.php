<?php

namespace App\Providers\Common\Models;

use App\Application\Common\Services\Models\UserActionService;
use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Domain\Common\Repositories\UserActionRepositoryContract;
use App\Domain\Common\Services\Models\UserActionServiceContract;
use App\Infrastructure\Common\Factories\Models\UserActionDTOFactory;
use App\Infrastructure\Common\Repositories\UserActionRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class UserActionDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        UserActionDTOFactoryContract::class => UserActionDTOFactory::class,
        UserActionServiceContract::class => UserActionService::class,
        UserActionRepositoryContract::class => UserActionRepository::class,
    ];
}
