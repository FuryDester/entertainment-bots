<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

abstract class AbstractDependencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [];

    public array $bindings = [];

    protected array $manualBindings = [];

    public function provides(): array
    {
        return [
            ...array_keys($this->singletons),
            ...array_keys($this->bindings),
            ...array_unique($this->manualBindings),
        ];
    }
}
