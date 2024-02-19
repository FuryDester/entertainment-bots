<?php

namespace App\Providers\Common\Templator;

use App\Application\Common\Services\Templator\BaseTemplatorService;
use App\Domain\Common\Services\Templator\BaseTemplatorServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class BaseTemplatorDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        BaseTemplatorServiceContract::class => BaseTemplatorService::class,
    ];
}
