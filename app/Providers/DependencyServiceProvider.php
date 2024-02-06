<?php

namespace App\Providers;

use App\Domain\VK\Factories\Common\GeoParts\CoordinatesDTOFactoryContract;
use App\Domain\VK\Factories\Common\GeoParts\PlaceDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ClientInfoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\Factories\Common\GeoParts\CoordinatesDTOFactory;
use App\Infrastructure\VK\Factories\Common\GeoParts\PlaceDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ActionDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactory;
use App\Infrastructure\VK\Factories\Common\MessageParts\ClientInfoDTOFactory;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// TODO: Restart provider so all binds won't be in the same place
class DependencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PhotoDTOFactoryContract::class => PhotoDTOFactory::class,
        CoordinatesDTOFactoryContract::class => CoordinatesDTOFactory::class,
        PlaceDTOFactoryContract::class => PlaceDTOFactory::class,
        ActionDTOFactoryContract::class => ActionDTOFactory::class,
        ClientInfoDTOFactoryContract::class => ClientInfoDTOFactory::class,
    ];

    public array $bindings = [];

    protected array $manualBindings = [];

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

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            ...array_keys($this->singletons),
            ...array_keys($this->bindings),
            ...array_keys($this->manualBindings),
        ];
    }

    protected function manualBind(string $abstract, string|callable $concrete, bool $singleton = true): void
    {
        $this->app->bind($abstract, $concrete, $singleton);
        $this->manualBindings[$abstract] = $concrete;
    }
}
