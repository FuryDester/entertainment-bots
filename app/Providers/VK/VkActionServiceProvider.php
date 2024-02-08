<?php

namespace App\Providers\VK;

use App\Application\VK\Services\Actions\ActionService;
use App\Domain\VK\Services\Actions\ActionServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class VkActionServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        ActionServiceContract::class => ActionService::class,
    ];
}
