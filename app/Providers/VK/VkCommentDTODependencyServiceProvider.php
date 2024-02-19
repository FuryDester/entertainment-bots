<?php

namespace App\Providers\VK;

use App\Domain\VK\Factories\Common\CommentDTOFactoryContract;
use App\Domain\VK\Factories\Common\CommentParts\DonutDTOFactoryContract;
use App\Domain\VK\Factories\Common\CommentParts\ThreadDTOFactoryContract;
use App\Infrastructure\VK\Factories\Common\CommentDTOFactory;
use App\Infrastructure\VK\Factories\Common\CommentParts\DonutDTOFactory;
use App\Infrastructure\VK\Factories\Common\CommentParts\ThreadDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class VkCommentDTODependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        DonutDTOFactoryContract::class => DonutDTOFactory::class,
        ThreadDTOFactoryContract::class => ThreadDTOFactory::class,
        CommentDTOFactoryContract::class => CommentDTOFactory::class,
    ];
}
