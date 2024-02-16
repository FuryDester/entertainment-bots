<?php

namespace App\Providers\VK\Api;

use App\Application\VK\Services\Api\UploadImageService;
use App\Domain\VK\Services\Api\UploadImageServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class VkUploadImageServiceDependencyProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        UploadImageServiceContract::class => UploadImageService::class,
    ];
}
