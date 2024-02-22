<?php

namespace App\Listeners\GroupBoss;

use App\Domain\Common\Services\Models\UserActionServiceContract;
use App\Domain\GroupBoss\Services\GroupBossActionProcessorServiceContract;
use App\Events\GroupBoss\DamageTaken;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use Illuminate\Support\Facades\Log;

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

        /** @var GroupBossActionProcessorServiceContract $actionService */
        $actionService = app(GroupBossActionProcessorServiceContract::class);
        foreach ($actions as $action) {
            $processor = $actionService->getActionProcessor($action);

            if (! $processor) {
                Log::warning('Action processor not found', [
                    'action' => $action->toArray(),
                    'user' => $event->user->toArray(),
                ]);

                continue;
            }

            $processor->run($action, $event->boss, $event->user, $event->action, $event->comment);
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
