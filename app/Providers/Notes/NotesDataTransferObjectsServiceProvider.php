<?php

namespace App\Providers\Notes;

use App\Domain\Notes\Factories\NoteDTOFactoryContract;
use App\Infrastructure\Notes\Factories\NoteDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class NotesDataTransferObjectsServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        NoteDTOFactoryContract::class => NoteDTOFactory::class,
    ];
}
