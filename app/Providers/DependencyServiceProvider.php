<?php

namespace App\Providers;

use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [];

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
        $method = $singleton ? 'singleton' : 'bind';

        $this->app->{$method}($abstract, $concrete);
        $this->manualBindings[$abstract] = $concrete;
    }
}
