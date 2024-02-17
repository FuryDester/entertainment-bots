<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizService;
use App\Domain\Quiz\Factories\QuizDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Quiz\Factories\QuizDTOFactory;
use App\Infrastructure\Quiz\Repositories\Models\QuizRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizRepositoryContract::class => QuizRepository::class,
        QuizServiceContract::class => QuizService::class,
        QuizDTOFactoryContract::class => QuizDTOFactory::class,
    ];
}
