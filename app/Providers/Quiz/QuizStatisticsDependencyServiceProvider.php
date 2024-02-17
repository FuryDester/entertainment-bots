<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\QuizStatisticsService;
use App\Domain\Quiz\Services\QuizStatisticsServiceContract;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizStatisticsDependencyServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizStatisticsServiceContract::class => QuizStatisticsService::class,
    ];
}
