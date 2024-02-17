<?php

namespace App\Application\PayloadActions\Actions;

use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Traits\QuizAvailability;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use App\Jobs\Quiz\SendQuizQuestion;
use Illuminate\Support\Facades\Log;

final readonly class QuizStartAction extends AbstractPayloadAction
{
    use QuizAvailability;
    use SendMessage;

    public function getActionName(): ActionStageEnum
    {
        return ActionStageEnum::QuizStart;
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleActions(): array
    {
        return [ActionStageEnum::Index, ActionStageEnum::QuizInfo];
    }

    protected function execute(MessageDTO $message, PayloadDTO $payload, UserDTO $user): bool
    {
        $quiz = $this->getQuizByPayload($payload);
        if (! $quiz) {
            $this->sendMessage($message->getPeerId(), 'Указанный тест не найден');
            Log::warning('Quiz not found', [
                'quiz_id' => $payload->getId(),
                'user' => $user->toArray(),
            ]);

            return true;
        }

        if (! $this->checkQuizAvailability($quiz, $user)) {
            $this->sendMessage($message->getPeerId(), 'Тест недоступен');

            return true;
        }

        return $this->processQuizStart($quiz, $user);
    }

    private function getQuizByPayload(PayloadDTO $payload): ?QuizDTO
    {
        $id = $payload->getId();
        /** @var QuizServiceContract $quizService */
        $quizService = app(QuizServiceContract::class);

        return $quizService->getQuizById($id);
    }

    private function processQuizStart(QuizDTO $quiz, UserDTO $user): bool
    {
        SendQuizQuestion::dispatch($user, $quiz);

        Log::info('Quiz started', [
            'quiz' => $quiz->toArray(),
            'user' => $user->toArray(),
        ]);

        return true;
    }
}
