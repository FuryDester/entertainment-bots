<?php

namespace App\Domain\Quiz\Services;

use App\Infrastructure\Quiz\ActionProcessor\AbstractQuizActionProcessor;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;

interface QuizActionProcessorServiceContract
{
    public function getActionProcessor(QuizActionDTO $action): ?AbstractQuizActionProcessor;
}
