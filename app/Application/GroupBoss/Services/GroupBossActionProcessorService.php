<?php

namespace App\Application\GroupBoss\Services;

use App\Domain\GroupBoss\Services\GroupBossActionProcessorServiceContract;
use App\Domain\Quiz\Services\Models\QuizActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\GroupBoss\ActionProcessor\AbstractGroupBossActionProcessor;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;

final readonly class GroupBossActionProcessorService implements GroupBossActionProcessorServiceContract
{
    /**
     * @throws Exception
     */
    public function getActionProcessor(UserActionDTO $action): ?AbstractGroupBossActionProcessor
    {
        $processors = ClassFinder::getClassesInNamespace('App\Application\GroupBoss\ActionProcessor');

        /** @var QuizActionServiceContract $quizActionService */
        $quizActionService = app(QuizActionServiceContract::class);
        foreach ($processors as $processor) {
            $processor = new $processor();
            if (! $processor instanceof AbstractGroupBossActionProcessor) {
                Log::warning("Class $processor is not an instance of AbstractGroupBossActionProcessor");

                continue;
            }

            $quizAction = $quizActionService->getById($action->getQuizActionId());
            if ($processor->getActionAlias() === $quizAction->getAlias()) {
                return $processor;
            }
        }

        return null;
    }
}
