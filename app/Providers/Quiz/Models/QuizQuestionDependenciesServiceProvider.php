<?php

namespace App\Providers\Quiz\Models;

use App\Application\Quiz\Services\Models\QuizQuestionService;
use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizQuestionRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizQuestionServiceContract;
use App\Infrastructure\Quiz\Factories\QuizQuestionDTOFactory;
use App\Infrastructure\Quiz\Repositories\Models\QuizQuestionRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizQuestionDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizQuestionDTOFactoryContract::class => QuizQuestionDTOFactory::class,
        QuizQuestionRepositoryContract::class => QuizQuestionRepository::class,
        QuizQuestionServiceContract::class => QuizQuestionService::class,
    ];
}
