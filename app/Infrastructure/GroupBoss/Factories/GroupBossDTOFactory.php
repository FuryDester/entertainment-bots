<?php

namespace App\Infrastructure\GroupBoss\Factories;

use App\Domain\GroupBoss\Factories\GroupBossDTOFactoryContract;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Models\GroupBoss\GroupBoss;
use Illuminate\Support\Carbon;

final class GroupBossDTOFactory implements GroupBossDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): GroupBossDTO
    {
        return (new GroupBossDTO)
            ->setId($data['id'] ?? null)
            ->setUserId($data['user_id'])
            ->setPostId($data['post_id'])
            ->setName($data['name'])
            ->setPostContent($data['post_content'])
            ->setImage($data['image'] ?? null)
            ->setMaxHealth($data['max_health'])
            ->setCurrentHealth($data['current_health'])
            ->setBaseHitChance($data['base_hit_chance'])
            ->setHitCooldown($data['hit_cooldown'])
            ->setMissCooldown($data['miss_cooldown'])
            ->setKilledBy($data['killed_by'] ?? null)
            ->setKilledAt(($data['killed_at'] ?? null) ? new Carbon($data['killed_at']) : null)
            ->setCreatedAt(($data['created_at'] ?? null) ? new Carbon($data['created_at']) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? new Carbon($data['updated_at']) : null);
    }

    public static function createFromModel(GroupBoss $model): GroupBossDTO
    {
        return (new GroupBossDTO)
            ->setId($model->id)
            ->setUserId($model->user_id)
            ->setPostId($model->post_id)
            ->setName($model->name)
            ->setPostContent($model->post_content)
            ->setImage($model->image)
            ->setMaxHealth($model->max_health)
            ->setCurrentHealth($model->current_health)
            ->setBaseHitChance($model->base_hit_chance)
            ->setHitCooldown($model->hit_cooldown)
            ->setMissCooldown($model->miss_cooldown)
            ->setKilledBy($model->killed_by)
            ->setKilledAt($model->killed_at ? new Carbon($model->killed_at) : null)
            ->setCreatedAt($model->created_at ? new Carbon($model->created_at) : null)
            ->setUpdatedAt($model->updated_at ? new Carbon($model->updated_at) : null);
    }
}
