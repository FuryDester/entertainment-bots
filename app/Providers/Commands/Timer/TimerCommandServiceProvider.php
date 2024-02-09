<?php

namespace App\Providers\Commands\Timer;

use App\Domain\Commands\Timer\Factories\TimerJobPayloadDTOFactoryContract;
use App\Infrastructure\Commands\Timer\Factories\TimerJobPayloadDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class TimerCommandServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        TimerJobPayloadDTOFactoryContract::class => TimerJobPayloadDTOFactory::class,
    ];
}
