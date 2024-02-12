<?php

namespace App\Providers\Commands\Timer;

use App\Domain\Commands\Factories\Timer\TimerJobPayloadDTOFactoryContract;
use App\Infrastructure\Commands\Factories\Timer\TimerJobPayloadDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class TimerCommandServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        TimerJobPayloadDTOFactoryContract::class => TimerJobPayloadDTOFactory::class,
    ];
}
