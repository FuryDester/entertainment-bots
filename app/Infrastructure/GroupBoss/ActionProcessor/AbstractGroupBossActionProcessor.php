<?php

namespace App\Infrastructure\GroupBoss\ActionProcessor;

use App\Domain\Quiz\Services\Models\QuizActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use Illuminate\Support\Facades\Log;

abstract readonly class AbstractGroupBossActionProcessor
{
    /**
     * @return ActionAliasTypeEnum|ActionAliasTypeEnum[]
     */
    abstract public function getActionAlias(): ActionAliasTypeEnum|array;

    public function isProcessable(QuizActionDTO $action): bool
    {
        return $action->getAlias() === $this->getActionAlias();
    }

    public function run(
        UserActionDTO $action,
        GroupBossDTO $boss,
        UserDTO $user,
        GroupBossUserActionDTO $bossAction,
        CommentDTO $comment,
    ): void {
        /** @var QuizActionServiceContract $actionService */
        $actionService = app(QuizActionServiceContract::class);
        $quizAction = $actionService->getById($action->getQuizActionId());
        if (! $quizAction || ! $this->isProcessable($quizAction)) {
            Log::warning('Quiz action not found or not processable', [
                'action' => $action->toArray(),
                'quiz_action' => $quizAction?->toArray(),
                'processor' => static::class,
            ]);

            return;
        }

        Log::info('Boss action processing', [
            'boss_id' => $boss->getId(),
            'user_id' => $user->getId(),
            'action' => $action->toArray(),
            'boss_action' => $bossAction->toArray(),
            'comment' => $comment->toArray(),
        ]);

        $this->processAction($action, $boss, $user, $bossAction, $comment, $quizAction);

        Log::info('Boss action processed', [
            'boss_id' => $boss->getId(),
            'user_id' => $user->getId(),
            'action' => $action->toArray(),
            'boss_action' => $bossAction->toArray(),
            'comment' => $comment->toArray(),
        ]);
    }

    abstract public function processAction(
        UserActionDTO $action,
        GroupBossDTO $boss,
        UserDTO $user,
        GroupBossUserActionDTO $bossAction,
        CommentDTO $comment,
        QuizActionDTO $quizAction,
    ): void;
}
