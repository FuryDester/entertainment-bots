<?php

namespace App\Providers\Quiz;

use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Infrastructure\Quiz\Factories\QuizActionDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizFactoriesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizActionDTOFactoryContract::class => QuizActionDTOFactory::class,
    ];
}
