<?php

namespace App\Domain\GroupBoss\Factories;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Models\GroupBoss\GroupBossWeapon;
use Illuminate\Support\Carbon;

interface GroupBossWeaponDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     group_boss_id: int,
     *     name: string,
     *     hit_damage_template?: string,
     *     min_damage: int,
     *     max_damage: int,
     *     hit_chance: int,
     *     created_at?: string|Carbon,
     *     updated_at?: string|Carbon,
     * } $data
     */
    public static function createFromData(array $data): GroupBossWeaponDTO;

    public static function createFromModel(GroupBossWeapon $model): GroupBossWeaponDTO;
}
