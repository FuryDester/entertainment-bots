<?php

namespace App\Infrastructure\Quiz\ActionProcessor;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Facades\Log;

abstract readonly class AbstractQuizActionProcessor
{
    /**
     * @return ActionAliasTypeEnum|ActionAliasTypeEnum[]
     */
    abstract public function getActionAlias(): ActionAliasTypeEnum|array;

    /**
     * @return ActionTypeEnum|ActionTypeEnum[]
     */
    abstract public function getActionType(): ActionTypeEnum|array;

    public function isProcessable(QuizActionDTO $action): bool
    {
        $aliases = is_array($this->getActionAlias()) ? $this->getActionAlias() : [$this->getActionAlias()];
        if (! in_array($action->getAlias(), $aliases, true)) {
            return false;
        }

        $types = is_array($this->getActionType()) ? $this->getActionType() : [$this->getActionType()];

        return in_array($action->getType(), $types, true);
    }

    public function run(
        QuizDTO $quiz,
        UserDTO $user,
        QuizActionDTO $action,
        QuizUserAnswerDTO $userAnswer,
    ): void {
        if (! $this->isProcessable($action)) {
            Log::warning('Action is not processable', [
                'quiz_id' => $quiz->getId(),
                'user_id' => $user->getId(),
                'action' => $action->toArray(),
                'user_answer_id' => $userAnswer->getId(),
            ]);

            return;
        }

        Log::info('Processing action', [
            'quiz_id' => $quiz->getId(),
            'user_id' => $user->getId(),
            'action' => $action->toArray(),
            'user_answer_id' => $userAnswer->getId(),
        ]);
        $this->processAction($quiz, $user, $action, $userAnswer);
    }

    abstract public function processAction(
        QuizDTO $quiz,
        UserDTO $user,
        QuizActionDTO $action,
        QuizUserAnswerDTO $userAnswer,
    ): void;
}
