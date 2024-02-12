<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\Models\QuizService;
use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Quiz\Repositories\QuizRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizRepositoryContract::class => QuizRepository::class,
        QuizServiceContract::class => QuizService::class,
    ];
}
