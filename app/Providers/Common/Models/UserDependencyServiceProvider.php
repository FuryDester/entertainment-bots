<?php

namespace App\Providers\Common\Models;

use App\Application\Common\Services\Models\UserService;
use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Domain\Common\Repositories\UserRepositoryContract;
use App\Domain\Common\Services\Models\UserServiceContract;
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
