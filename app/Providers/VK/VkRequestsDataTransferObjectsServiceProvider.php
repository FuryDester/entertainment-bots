<?php

namespace App\Providers\VK;

use App\Domain\VK\Factories\Requests\CallbackRequestDTOFactoryContract;
use App\Infrastructure\VK\Factories\Requests\CallbackRequestDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class VkRequestsDataTransferObjectsServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        CallbackRequestDTOFactoryContract::class => CallbackRequestDTOFactory::class,
    ];
}
