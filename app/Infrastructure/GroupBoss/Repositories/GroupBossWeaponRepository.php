<?php

namespace App\Infrastructure\GroupBoss\Repositories;

use App\Domain\GroupBoss\Factories\GroupBossWeaponDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossWeaponRepositoryContract;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\GroupBoss\Enums\GroupBossTagsEnum;
use App\Models\GroupBoss\GroupBossWeapon;
use Illuminate\Support\Facades\Cache;

final readonly class GroupBossWeaponRepository implements GroupBossWeaponRepositoryContract
{
    use FormBaseCacheKey;

    public function getWeaponByNameAndBoss(GroupBossDTO $boss, string $name): ?GroupBossWeaponDTO
    {
        $name = mb_strtolower(trim($name));

        return Cache::tags(GroupBossTagsEnum::GroupBossWeaponRepository->value)
            ->remember(
                $this->formBaseCacheKey($boss->getId(), $name),
                CacheTimeEnum::DAY->value * 5,
                static function () use ($boss, $name) {
                    $model = GroupBossWeapon::where('group_boss_id', $boss->getId())
                        ->where('name', $name)
                        ->first();

                    if (! $model) {
                        return null;
                    }

                    /** @var GroupBossWeaponDTOFactoryContract $factory */
                    $factory = app(GroupBossWeaponDTOFactoryContract::class);
                    return $factory::createFromModel($model);
                }
            );
    }
}
