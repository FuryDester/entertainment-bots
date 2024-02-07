<?php

namespace App\Providers\VK;

use App\Application\VK\Services\Models\VkEventService;
use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Domain\VK\Repositories\VkEventRepositoryContract;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use App\Infrastructure\VK\Factories\Models\VkEventDTOFactory;
use App\Infrastructure\VK\Repositories\VkEventRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class VkEventModelServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        VkEventDTOFactoryContract::class => VkEventDTOFactory::class,
        VkEventRepositoryContract::class => VkEventRepository::class,
        VkEventServiceContract::class => VkEventService::class,
    ];
}
