<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\QuizActionProcessorService;
use App\Domain\Quiz\Services\QuizActionProcessorServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizActionProcessorDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizActionProcessorServiceContract::class => QuizActionProcessorService::class,
    ];
}
