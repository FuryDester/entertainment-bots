<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizUserAnswerService;
use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizUserAnswerRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizUserAnswerServiceContract;
use App\Infrastructure\Quiz\Factories\QuizUserAnswerDTOFactory;
use App\Infrastructure\Quiz\Repositories\Models\QuizUserAnswerRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizUserAnswerDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizUserAnswerDTOFactoryContract::class => QuizUserAnswerDTOFactory::class,
        QuizUserAnswerRepositoryContract::class => QuizUserAnswerRepository::class,
        QuizUserAnswerServiceContract::class => QuizUserAnswerService::class,
    ];
}
