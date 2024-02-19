<?php

namespace App\Providers\Common;

use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Infrastructure\Common\Factories\Models\UserActionDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class UserActionDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        UserActionDTOFactoryContract::class => UserActionDTOFactory::class,
    ];
}
