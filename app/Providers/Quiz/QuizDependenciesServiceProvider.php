<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\QuizService;
use App\Domain\Quiz\Factories\QuizDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Domain\Quiz\Services\QuizServiceContract;
use App\Infrastructure\Quiz\Factories\QuizDTOFactory;
use App\Infrastructure\Quiz\Repositories\QuizRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizRepositoryContract::class => QuizRepository::class,
        QuizServiceContract::class => QuizService::class,
        QuizDTOFactoryContract::class => QuizDTOFactory::class,
    ];
}
