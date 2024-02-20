<?php

namespace App\Listeners\Quiz;

use App\Domain\Quiz\Services\Models\QuizActionServiceContract;
use App\Domain\Quiz\Services\QuizActionProcessorServiceContract;
use App\Events\Quiz\QuizQuestionAnswered;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Facades\Log;

final class CheckForQuestionAction
{
    /**
     * Handle the event.
     */
    public function handle(QuizQuestionAnswered $event): void
    {
        $actionDetail = $this->getActionDetail($event);
        if ($actionDetail === null) {
            return;
        }

        /** @var QuizActionProcessorServiceContract $processorService */
        $processorService = app(QuizActionProcessorServiceContract::class);
        $processor = $processorService->getActionProcessor($actionDetail);
        if ($processor === null) {
            Log::error('QuizActionProcessor not found', [
                'quiz_id' => $event->quiz->getId(),
                'action_id' => $actionDetail->getId()
            ]);

            return;
        }

        $processor->run($event->quiz, $event->user, $actionDetail, $event->userAnswer);
    }

    /**
     * Получение информации о действии вопроса
     */
    private function getActionDetail(QuizQuestionAnswered $event): ?QuizActionDTO
    {
        $quizActionId = $event->quiz->getActionId();
        if ($quizActionId === null) {
            return null;
        }

        /** @var QuizActionServiceContract $actionService */
        $actionService = app(QuizActionServiceContract::class);
        $actionDetail = $actionService->getById($quizActionId);

        if ($actionDetail === null) {
            Log::error('QuizAction not found', ['quiz_id' => $event->quiz->getId(), 'action_id' => $quizActionId]);
        }

        return $actionDetail->getType() === ActionTypeEnum::PerQuestion ? $actionDetail : null;
    }
}
