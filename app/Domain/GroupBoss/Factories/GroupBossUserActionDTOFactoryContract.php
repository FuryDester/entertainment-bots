<?php

namespace App\Domain\GroupBoss\Factories;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Models\GroupBoss\GroupBossUserAction;
use Illuminate\Support\Carbon;

interface GroupBossUserActionDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     user_id: int,
     *     group_boss_id: int,
     *     group_boss_weapon_id: int,
     *     damage: int,
     *     is_miss?: bool,
     *     created_at?: string|Carbon,
     *     updated_at?: string|Carbon,
     * } $data
     */
    public static function createFromData(array $data): GroupBossUserActionDTO;

    public static function createFromModel(GroupBossUserAction $model): GroupBossUserActionDTO;
}
