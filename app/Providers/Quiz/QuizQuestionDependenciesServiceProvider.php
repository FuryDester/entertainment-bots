<?php

namespace App\Providers\Quiz;

use App\Application\Quiz\Services\QuizQuestionService;
use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizQuestionRepositoryContract;
use App\Domain\Quiz\Services\QuizQuestionServiceContract;
use App\Infrastructure\Quiz\Factories\QuizQuestionDTOFactory;
use App\Infrastructure\Quiz\Repositories\QuizQuestionRepository;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizQuestionDependenciesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizQuestionDTOFactoryContract::class => QuizQuestionDTOFactory::class,
        QuizQuestionRepositoryContract::class => QuizQuestionRepository::class,
        QuizQuestionServiceContract::class => QuizQuestionService::class,
    ];
}
