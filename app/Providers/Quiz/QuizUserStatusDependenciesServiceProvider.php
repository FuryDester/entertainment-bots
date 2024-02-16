<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\QuizUserStatusesService;
use App\Domain\Quiz\Factories\QuizUserStatusDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizUserStatusesRepositoryContract;
use App\Domain\Quiz\Services\QuizUserStatusesServiceContract;
use App\Infrastructure\Quiz\Factories\QuizUserStatusDTOFactory;
use App\Infrastructure\Quiz\Repositories\QuizUserStatusesRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizUserStatusDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizUserStatusesRepositoryContract::class => QuizUserStatusesRepository::class,
        QuizUserStatusesServiceContract::class => QuizUserStatusesService::class,
        QuizUserStatusDTOFactoryContract::class => QuizUserStatusDTOFactory::class,
    ];
}
