<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizActionService;
use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizActionRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizActionServiceContract;
use App\Infrastructure\Quiz\Factories\QuizActionDTOFactory;
use App\Infrastructure\Quiz\Repositories\QuizActionRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizActionDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizActionDTOFactoryContract::class => QuizActionDTOFactory::class,
        QuizActionServiceContract::class => QuizActionService::class,
        QuizActionRepositoryContract::class => QuizActionRepository::class,
    ];
}
