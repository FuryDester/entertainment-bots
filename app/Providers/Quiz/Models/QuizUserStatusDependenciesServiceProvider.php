<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizUserStatusesService;
use App\Domain\Quiz\Factories\QuizUserStatusDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizUserStatusesRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizUserStatusesServiceContract;
use App\Infrastructure\Quiz\Factories\QuizUserStatusDTOFactory;
use App\Infrastructure\Quiz\Repositories\Models\QuizUserStatusesRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizUserStatusDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizUserStatusesRepositoryContract::class => QuizUserStatusesRepository::class,
        QuizUserStatusesServiceContract::class => QuizUserStatusesService::class,
        QuizUserStatusDTOFactoryContract::class => QuizUserStatusDTOFactory::class,
    ];
}
