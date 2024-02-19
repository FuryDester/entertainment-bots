<?php

namespace App\Infrastructure\GroupBoss\Factories;

use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Models\GroupBoss\GroupBossUserAction;
use Illuminate\Support\Carbon;

final class GroupBossUserActionDTOFactory implements GroupBossUserActionDTOFactoryContract
{
    public static function createFromData(array $data): GroupBossUserActionDTO
    {
        return (new GroupBossUserActionDTO)
            ->setId($data['id'] ?? null)
            ->setUserId($data['user_id'])
            ->setGroupBossId($data['group_boss_id'])
            ->setGroupBossWeaponId($data['group_boss_weapon_id'])
            ->setDamage($data['damage'])
            ->setIsMiss($data['is_miss'] ?? false)
            ->setCreatedAt(($data['created_at'] ?? null) ? new Carbon($data['created_at']) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? new Carbon($data['updated_at']) : null);
    }

    public static function createFromModel(GroupBossUserAction $model): GroupBossUserActionDTO
    {
        return (new GroupBossUserActionDTO)
            ->setId($model->id)
            ->setUserId($model->user_id)
            ->setGroupBossId($model->group_boss_id)
            ->setGroupBossWeaponId($model->group_boss_weapon_id)
            ->setDamage($model->damage)
            ->setIsMiss((bool) $model->is_miss)
            ->setCreatedAt($model->created_at ? new Carbon($model->created_at) : null)
            ->setUpdatedAt($model->updated_at ? new Carbon($model->updated_at) : null);
    }
}
