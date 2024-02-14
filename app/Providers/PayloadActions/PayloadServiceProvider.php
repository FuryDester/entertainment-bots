<?php

namespace App\Providers\PayloadActions;

use App\Application\PayloadActions\Services\PayloadActionService;
use App\Domain\PayloadActions\PayloadActionServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class PayloadServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        PayloadActionServiceContract::class => PayloadActionService::class,
    ];
}
