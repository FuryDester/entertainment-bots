<?php

namespace App\Domain\GroupBoss\Factories;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Models\GroupBoss\GroupBoss;
use Illuminate\Support\Carbon;

interface GroupBossDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     user_id: int,
     *     post_id: int,
     *     name: string,
     *     post_content: string,
     *     image?: string,
     *     max_health: int,
     *     current_health: int,
     *     base_hit_chance: int,
     *     hit_cooldown: int,
     *     miss_cooldown: int,
     *     killed_by?: int,
     *     killed_at?: string|Carbon,
     *     created_at?: string|Carbon,
     *     updated_at?: string|Carbon,
     * } $data
     */
    public static function createFromData(array $data): GroupBossDTO;

    public static function createFromModel(GroupBoss $model): GroupBossDTO;
}
