<?php

namespace App\Infrastructure\GroupBoss\Factories;

use App\Domain\GroupBoss\Factories\GroupBossWeaponDTOFactoryContract;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Models\GroupBoss\GroupBossWeapon;
use Illuminate\Support\Carbon;

final class GroupBossWeaponDTOFactory implements GroupBossWeaponDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): GroupBossWeaponDTO
    {
        return (new GroupBossWeaponDTO)
            ->setId($data['id'] ?? null)
            ->setGroupBossId($data['group_boss_id'])
            ->setName($data['name'])
            ->setHitDamageTemplate($data['hit_damage_template'] ?? null)
            ->setMinDamage($data['min_damage'])
            ->setMaxDamage($data['max_damage'])
            ->setHitChance($data['hit_chance'])
            ->setCreatedAt($data['created_at'] ? new Carbon($data['created_at']) : null)
            ->setUpdatedAt($data['updated_at'] ? new Carbon($data['updated_at']) : null);
    }

    public static function createFromModel(GroupBossWeapon $model): GroupBossWeaponDTO
    {
        return (new GroupBossWeaponDTO)
            ->setId($model->id)
            ->setGroupBossId($model->group_boss_id)
            ->setName($model->name)
            ->setHitDamageTemplate($model->hit_damage_template)
            ->setMinDamage($model->min_damage)
            ->setMaxDamage($model->max_damage)
            ->setHitChance($model->hit_chance)
            ->setCreatedAt($model->created_at ? new Carbon($model->created_at) : null)
            ->setUpdatedAt($model->updated_at ? new Carbon($model->updated_at) : null);
    }
}
