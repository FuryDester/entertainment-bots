<?php

namespace App\Providers\VK;

use App\Domain\VK\Factories\Common\GeoDTOFactoryContract;
use App\Domain\VK\Factories\Common\GeoParts\CoordinatesDTOFactoryContract;
use App\Domain\VK\Factories\Common\GeoParts\PlaceDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ClientInfoDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ForwardMessageDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\MessageDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\Factories\Common\GeoDTOFactory;
use App\Infrastructure\VK\Factories\Common\GeoParts\CoordinatesDTOFactory;
use App\Infrastructure\VK\Factories\Common\GeoParts\PlaceDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageContextDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ActionDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ClientInfoDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ForwardMessageDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\MessageDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class VkDataTransferObjectsServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        PhotoDTOFactoryContract::class => PhotoDTOFactory::class,
        CoordinatesDTOFactoryContract::class => CoordinatesDTOFactory::class,
        PlaceDTOFactoryContract::class => PlaceDTOFactory::class,
        ActionDTOFactoryContract::class => ActionDTOFactory::class,
        ClientInfoDTOFactoryContract::class => ClientInfoDTOFactory::class,
        MessageDTOFactoryContract::class => MessageDTOFactory::class,
        GeoDTOFactoryContract::class => GeoDTOFactory::class,
        MessageContextDTOFactoryContract::class => MessageContextDTOFactory::class,
        ForwardMessageDTOFactoryContract::class => ForwardMessageDTOFactory::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->manualBind(
            AccessTokenDTO::class,
            fn() => AccessTokenDTO::getInstance()->setAccessToken(config('integrations.vk.access_token')),
        );
    }
}
