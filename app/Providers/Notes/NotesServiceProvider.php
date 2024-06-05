<?php

namespace App\Providers\Notes;

use App\Application\Notes\Services\NoteService;
use App\Domain\Notes\Repositories\NoteRepositoryContract;
use App\Domain\Notes\Services\Models\NoteServiceContract;
use App\Infrastructure\Notes\Repositories\NoteRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class NotesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        NoteRepositoryContract::class => NoteRepository::class,
        NoteServiceContract::class => NoteService::class,
    ];
}
