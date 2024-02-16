<?php

namespace App\Providers\Common;

use App\Application\Common\Services\UserService;
use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Domain\Common\Repositories\UserRepositoryContract;
use App\Domain\Common\Services\UserServiceContract;
use App\Infrastructure\Common\Factories\Models\UserDTOFactory;
use App\Infrastructure\Common\Repositories\UserRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class UserDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        UserDTOFactoryContract::class => UserDTOFactory::class,
        UserRepositoryContract::class => UserRepository::class,
        UserServiceContract::class => UserService::class,
    ];
}
