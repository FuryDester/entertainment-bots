<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

abstract class AbstractDependencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [];

    public array $bindings = [];

    protected array $manualBindings = [];

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
