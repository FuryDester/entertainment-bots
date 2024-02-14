<?php

namespace App\Providers\PayloadActions;

use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Infrastructure\PayloadActions\Factories\PayloadDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class PayloadDataTransferObjectsServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        PayloadDTOFactoryContract::class => PayloadDTOFactory::class,
    ];
}
