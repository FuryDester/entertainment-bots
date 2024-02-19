<?php

namespace App\Infrastructure\GroupBoss\Repositories;

use App\Domain\GroupBoss\Factories\GroupBossUserActionDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossUserActionRepositoryContract;
use App\Events\GroupBoss\Models\GroupBossUserActionUpdated;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\GroupBoss\Enums\GroupBossTagsEnum;
use App\Models\GroupBoss\GroupBossUserAction;
use Illuminate\Support\Facades\Cache;

final readonly class GroupBossUserActionRepository implements GroupBossUserActionRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    public function findLastActionByUserAndBoss(UserDTO $user, GroupBossDTO $boss): ?GroupBossUserActionDTO
    {
        return Cache::tags(GroupBossTagsEnum::GroupBossUserActionRepository->value)
            ->remember(
                $this->formBaseCacheKey($user->getId(), $boss->getId()),
                CacheTimeEnum::HOUR->value * 2,
                static function () use ($user, $boss) {
                    $model = GroupBossUserAction::where('user_id', $user->getId())
                        ->where('group_boss_id', $boss->getId())
                        ->orderBy('created_at', 'desc')
                        ->first();

                    if (!$model) {
                        return null;
                    }

                    /** @var GroupBossUserActionDTOFactoryContract $factory */
                    $factory = app(GroupBossUserActionDTOFactoryContract::class);
                    return $factory::createFromModel($model);
                }
            );
    }

    public function save(GroupBossUserActionDTO $action): bool
    {
        $result = $this->saveDto(new GroupBossUserAction, $action);
        if ($result) {
            GroupBossUserActionUpdated::dispatch();
        }

        return $result;
    }
}
