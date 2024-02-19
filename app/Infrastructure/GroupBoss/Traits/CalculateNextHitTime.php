<?php

namespace App\Infrastructure\GroupBoss\Traits;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use Illuminate\Support\Carbon;

trait CalculateNextHitTime
{
    /**
     * Просчёт времени следующего удара.
     * @return Carbon Время следующего удара.
     */
    private function calculateNextHitTime(GroupBossDTO $boss, GroupBossUserActionDTO $userAction): Carbon
    {
        return $userAction
            ->getCreatedAt()
            ->copy()
            ->add('minutes', $userAction->isMiss() ? $boss->getMissCooldown() : $boss->getHitCooldown());
    }
}
