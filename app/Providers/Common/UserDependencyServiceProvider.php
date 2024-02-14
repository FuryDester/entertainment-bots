<?php

namespace App\Providers\Common;

use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Infrastructure\Common\Factories\Models\UserDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class UserDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        UserDTOFactoryContract::class => UserDTOFactory::class,
    ];
}
