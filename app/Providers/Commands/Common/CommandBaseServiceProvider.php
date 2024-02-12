<?php

namespace App\Providers\Commands\Common;

use App\Domain\Commands\Factories\Common\CommandArgumentDTOFactoryContract;
use App\Infrastructure\Commands\Factories\Common\CommandArgumentDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class CommandBaseServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        CommandArgumentDTOFactoryContract::class => CommandArgumentDTOFactory::class,
    ];
}
