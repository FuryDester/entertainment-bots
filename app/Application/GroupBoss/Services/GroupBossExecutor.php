<?php

namespace App\Application\GroupBoss\Services;

use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Domain\GroupBoss\Services\GroupBossExecutorContract;
use App\Domain\GroupBoss\Services\GroupBossTemplatorContract;
use App\Domain\GroupBoss\Services\Models\GroupBossServiceContract;
use App\Domain\GroupBoss\Services\Models\GroupBossUserActionServiceContract;
use App\Domain\GroupBoss\Services\Models\GroupBossWeaponServiceContract;
use App\Events\GroupBoss\DamageTaken;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Traits\SecondsToHms;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\GroupBoss\Traits\CalculateNextHitTime;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Infrastructure\VK\Traits\Comments\SendComment;
use Illuminate\Support\Facades\Log;

final readonly class GroupBossExecutor implements GroupBossExecutorContract
{
    use CalculateNextHitTime;
    use SecondsToHms;
    use SendComment;

    /**
     * {@inheritDoc}
     */
    public function execute(CommentDTO $comment, UserDTO $user, GroupBossDTO $boss): bool
    {
        if (! $this->checkBossAndUserStatuses($comment, $boss, $user)) {
            return false;
        }

        if (! $weapon = $this->getWeaponByMessage($comment, $boss)) {
            return false;
        }

        $this->processBossHit($boss, $user, $comment, $weapon);

        return true;
    }

    /**
     * Проверка статусов группового босса и пользователя.
     * Проверяет доступность босса, а также возможность удара пользователем.
     *
     * @return bool true, если проверка пройдена, иначе false.
     */
    private function checkBossAndUserStatuses(CommentDTO $comment, GroupBossDTO $boss, UserDTO $user): bool
    {
        if ($boss->getCurrentHealth() <= 0 || $boss->getKilledBy()) {
            Log::warning('Group boss already killed', [
                'boss' => $boss->toArray(),
                'comment' => $comment->toArray(),
                'user' => $user->toArray(),
            ]);

            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                'Групповой босс уже повержен. Новые удары не принимаются.',
                ['reply_to_comment' => $comment->getId()],
            );

            return false;
        }

        /** @var GroupBossUserActionServiceContract $userActionService */
        $userActionService = app(GroupBossUserActionServiceContract::class);
        $userAction = $userActionService->findLastActionByUserAndBoss($user, $boss);
        if (! $userAction) {
            return true;
        }

        $nextHit = $this->calculateNextHitTime($boss, $userAction);
        $now = now();
        $result = $nextHit <= $now;
        if (! $result) {
            Log::warning('User hit too fast', [
                'boss' => $boss->toArray(),
                'comment' => $comment->toArray(),
                'user' => $user->toArray(),
                'next_hit' => $nextHit,
                'now' => $now->toString(),
            ]);

            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                sprintf(
                    'Вы слишком быстро наносите удары. Попробуйте ещё раз через %s',
                    $this->secondsToHms($nextHit->diffInSeconds($now))
                ),
                ['reply_to_comment' => $comment->getId()],
            );
        }

        return $result;
    }

    /**
     * Получение оружия пользователя по комментарию.
     */
    private function getWeaponByMessage(CommentDTO $comment, GroupBossDTO $boss): ?GroupBossWeaponDTO
    {
        /** @var GroupBossWeaponServiceContract $service */
        $service = app(GroupBossWeaponServiceContract::class);

        return $service->getWeaponNameByCommentAndBoss($boss, $comment);
    }

    private function processBossHit(
        GroupBossDTO $boss,
        UserDTO $user,
        CommentDTO $comment,
        GroupBossWeaponDTO $weapon,
    ): void {
        /** @var GroupBossUserActionDTOFactoryContract $userActionFactory */
        $userActionFactory = app(GroupBossUserActionDTOFactoryContract::class);
        $userAction = $userActionFactory::createFromData([
            'user_id' => $user->getId(),
            'group_boss_id' => $boss->getId(),
            'group_boss_weapon_id' => $weapon->getId(),
            'damage' => 0,
            'is_miss' => false,
        ]);

        $damageResult = $this->tryHitBoss($boss, $weapon);
        if ($damageResult === false) {
            $userAction->setIsMiss(true);
            if (! $this->trySaveUserAction($comment, $userAction)) {
                return;
            }

            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                "Вы промахнулись. Попробуйте ещё раз через {$this->secondsToHms($boss->getMissCooldown())}",
                ['reply_to_comment' => $comment->getId()],
            );

            return;
        }

        $userAction->setDamage($damageResult);
        $this->trySaveUserAction($comment, $userAction);

        $this->subtractHealthAndProcess($boss, $user, $comment, $weapon, $userAction);
    }

    /**
     * Попытка ударить группового босса.
     *
     * @return int|false количество урона, если не получилось ударить - false.
     */
    private function tryHitBoss(GroupBossDTO $boss, GroupBossWeaponDTO $weapon): int|false
    {
        $chance = ($boss->getBaseHitChance() / 100) * ($weapon->getHitChance() / 100);
        if (mt_rand(0, 100) > $chance) {
            return false;
        }

        return mt_rand($weapon->getMinDamage(), $weapon->getMaxDamage());
    }

    /**
     * Попытка сохранить действие пользователя.
     * При неудаче отправляет сообщение об ошибке.
     */
    private function trySaveUserAction(
        CommentDTO $comment,
        GroupBossUserActionDTO $userAction
    ): bool {
        /** @var GroupBossUserActionServiceContract $userActionService */
        $userActionService = app(GroupBossUserActionServiceContract::class);

        $result = $userActionService->save($userAction);
        if (! $result) {
            Log::error('Failed to save user action', [
                'user_action' => $userAction->toArray(),
            ]);

            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                $this->getErrorMessage(),
                ['reply_to_comment' => $comment->getId()],
            );
        }

        return $result;
    }

    /**
     * Вычитание здоровья у босса.
     */
    private function subtractHealthAndProcess(
        GroupBossDTO $boss,
        UserDTO $user,
        CommentDTO $comment,
        GroupBossWeaponDTO $weapon,
        GroupBossUserActionDTO $action,
    ): void {
        $groupBossService = app(GroupBossServiceContract::class);
        $result = $groupBossService->subtractHealth($boss, $user, $action->getDamage());

        if ($result === null) {
            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                'Вы нанесли финальный удар по боссу! Поздравляем, босс убит!',
                ['reply_to_comment' => $comment->getId()],
            );

            return;
        }

        if (! $result) {
            $this->sendComment(
                $comment->getOwnerId(),
                $comment->getPostId(),
                $this->getErrorMessage(),
                ['reply_to_comment' => $comment->getId()],
            );

            return;
        }

        /** @var GroupBossTemplatorContract $templator */
        $templator = app(GroupBossTemplatorContract::class);
        $this->sendComment(
            $comment->getOwnerId(),
            $comment->getPostId(),
            $templator->finalizeDamageMessage($action->getDamage(), $weapon, $boss),
            ['reply_to_comment' => $comment->getId()]
        );

        Log::info('Boss hit', [
            'boss' => $boss->toArray(),
            'user' => $user->toArray(),
            'comment' => $comment->toArray(),
            'action' => $action->toArray(),
        ]);

        DamageTaken::dispatch($action, $comment, $user, $boss);
    }

    /**
     * Получение сообщения об ошибке.
     */
    private function getErrorMessage(): string
    {
        return 'Произошла ошибка при попытке ударить босса. Попробуйте ещё раз.';
    }
}
