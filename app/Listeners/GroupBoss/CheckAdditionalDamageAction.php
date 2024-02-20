<?php

namespace App\Listeners\GroupBoss;

use App\Domain\Common\Services\Models\UserActionServiceContract;
use App\Events\GroupBoss\DamageTaken;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;

final class CheckAdditionalDamageAction
{
    public function handle(DamageTaken $event): void
    {
        /** @var UserActionServiceContract $userActionService */
        $userActionService = app(UserActionServiceContract::class);

        $actions = $userActionService->getActiveActionsByUser($event->user, $this->getValidAliases());
        if (empty($actions)) {
            return;
        }

        // TODO (AbstractGroupBossActionProcessor): process actions
        foreach ($actions as $action) {
            // TODO: process actions
        }
    }

    /**
     * Получение списка действий, которые могут добавить урон
     *
     * @return ActionAliasTypeEnum[]
     */
    private function getValidAliases(): array
    {
        return [ActionAliasTypeEnum::BossAddDamage];
    }
}
