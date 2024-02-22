<?php

namespace App\Application\GroupBoss\ActionProcessor;

use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossServiceContract;
use App\Domain\GroupBoss\Services\Models\GroupBossUserActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\ActionProcessor\AbstractGroupBossActionProcessor;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Infrastructure\VK\Traits\Comments\SendComment;
use Illuminate\Support\Facades\Log;

final readonly class AdditionalDamageProcessor extends AbstractGroupBossActionProcessor
{
    use SendComment;

    /**
     * @inheritDoc
     */
    public function getActionAlias(): ActionAliasTypeEnum|array
    {
        return ActionAliasTypeEnum::BossAddDamage;
    }

    public function processAction(
        UserActionDTO $action,
        GroupBossDTO $boss,
        UserDTO $user,
        GroupBossUserActionDTO $bossAction,
        CommentDTO $comment,
        QuizActionDTO $quizAction,
    ): void {
        $damagePercent = $quizAction->getData()['damage_percent'] ?? null;
        if (! $damagePercent) {
            return;
        }

        $finalAdditionalDamage = floor($bossAction->getDamage() * (1 + ($damagePercent / 100)));

        /** @var GroupBossUserActionDTOFactoryContract $bossActionFactory */
        $bossActionFactory = app(GroupBossUserActionDTOFactoryContract::class);
        $newAction = $bossActionFactory::createFromData([
            'user_id' => $user->getId(),
            'group_boss_id' => $boss->getId(),
            'group_boss_weapon_id' => $bossAction->getGroupBossWeaponId(),
            'damage' => $finalAdditionalDamage,
            'is_miss' => false,
        ]);

        /** @var GroupBossServiceContract $groupBossService */
        $groupBossService = app(GroupBossServiceContract::class);
        $damageResult = $groupBossService->subtractHealth($boss, $user, $finalAdditionalDamage);

        $this->processDamageResult($comment, $newAction, $damageResult);

        /** @var GroupBossUserActionServiceContract $userActionService */
        $userActionService = app(GroupBossUserActionServiceContract::class);
        $result = $userActionService->save($newAction);
        if (! $result) {
            Log::warning('Failed to save additional damage action', [
                'action' => $newAction->toArray(),
            ]);
        }
    }

    /**
     * Функция для обработки сообщений, в зависимости от результата урона.
     */
    private function processDamageResult(CommentDTO $comment, GroupBossUserActionDTO $action, ?bool $damageResult): void
    {
        $replyTo = ['reply_to_comment' => $comment->getId()];

        if (null === $damageResult) {
            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                "Дополнительным уроном в количестве {$action->getDamage()} вы добили босса!",
                $replyTo,
            );

            return;
        }

        if (! $damageResult) {
            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                "Произошла неизвестная ошибка при нанесении дополнительного урона.",
                $replyTo,
            );

            return;
        }

        $this->sendComment(
            $comment->getOwnerId(),
            $comment->getPostId(),
            "Благодаря бонусу, Вы нанесли дополнительный урон в количестве {$action->getDamage()}!",
            $replyTo,
        );
    }
}
