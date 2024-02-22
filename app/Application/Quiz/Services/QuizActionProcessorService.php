<?php

namespace App\Application\Quiz\Services;

use App\Domain\Quiz\Services\QuizActionProcessorServiceContract;
use App\Infrastructure\Quiz\ActionProcessor\AbstractQuizActionProcessor;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;

final readonly class QuizActionProcessorService implements QuizActionProcessorServiceContract
{
    /**
     * @throws Exception
     */
    public function getActionProcessor(QuizActionDTO $action): ?AbstractQuizActionProcessor
    {
        $processorClasses = ClassFinder::getClassesInNamespace('App\Application\Quiz\ActionProcessor');
        foreach ($processorClasses as $processorClass) {
            $processor = new $processorClass();
            if (! $processor instanceof AbstractQuizActionProcessor) {
                Log::warning("Class $processorClass is not an instance of AbstractQuizActionProcessor");

                continue;
            }

            if ($processor->getActionAlias() === $action->getAlias()) {
                return $processor;
            }
        }

        return null;
    }
}
