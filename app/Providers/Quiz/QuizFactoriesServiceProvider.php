<?php

namespace App\Providers\Quiz;

use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Domain\Quiz\Factories\QuizAnswerDTOFactoryContract;
use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Infrastructure\Quiz\Factories\QuizActionDTOFactory;
use App\Infrastructure\Quiz\Factories\QuizAnswerDTOFactory;
use App\Infrastructure\Quiz\Factories\QuizQuestionDTOFactory;
use App\Infrastructure\Quiz\Factories\QuizUserAnswerDTOFactory;
use App\Providers\AbstractDependencyServiceProvider;

final class QuizFactoriesServiceProvider extends AbstractDependencyServiceProvider
{
    public array $singletons = [
        QuizActionDTOFactoryContract::class => QuizActionDTOFactory::class,
        QuizAnswerDTOFactoryContract::class => QuizAnswerDTOFactory::class,
        QuizQuestionDTOFactoryContract::class => QuizQuestionDTOFactory::class,
        QuizUserAnswerDTOFactoryContract::class => QuizUserAnswerDTOFactory::class,
    ];
}
