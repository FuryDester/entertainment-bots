<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizAnswerService;
use App\Domain\Quiz\Factories\QuizAnswerDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizAnswerRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizAnswerServiceContract;
use App\Infrastructure\Quiz\Factories\QuizAnswerDTOFactory;
use App\Infrastructure\Quiz\Repositories\Models\QuizAnswerRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizAnswerDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizAnswerRepositoryContract::class => QuizAnswerRepository::class,
        QuizAnswerServiceContract::class => QuizAnswerService::class,
        QuizAnswerDTOFactoryContract::class => QuizAnswerDTOFactory::class,
    ];
}
