<?php

namespace App\Infrastructure\GroupBoss\Repositories;

use App\Domain\GroupBoss\Factories\GroupBossDTOFactoryContract;
use App\Domain\GroupBoss\Repositories\GroupBossRepositoryContract;
use App\Events\GroupBoss\Models\GroupBossUpdated;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\Enums\GroupBossTagsEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Models\GroupBoss\GroupBoss;
use Illuminate\Support\Facades\Cache;

final readonly class GroupBossRepository implements GroupBossRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    public function findByComment(CommentDTO $comment): ?GroupBossDTO
    {
        return Cache::tags(GroupBossTagsEnum::GroupBossRepository->value)
            ->remember(
                $this->formBaseCacheKey($comment->getPostId()),
                CacheTimeEnum::HOUR->value * 3,
                static function () use ($comment) {
                    $model = GroupBoss::where('post_id', $comment->getPostId())->first();
                    if (! $model) {
                        return null;
                    }

                    /** @var GroupBossDTOFactoryContract $factory */
                    $factory = app(GroupBossDTOFactoryContract::class);

                    return $factory::createFromModel($model);
                }
            );
    }

    public function findById(int $id): ?GroupBossDTO
    {
        return Cache::tags(GroupBossTagsEnum::GroupBossRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::HOUR->value,
                static function () use ($id) {
                    $model = GroupBoss::find($id);
                    if (! $model) {
                        return null;
                    }

                    /** @var GroupBossDTOFactoryContract $factory */
                    $factory = app(GroupBossDTOFactoryContract::class);

                    return $factory::createFromModel($model);
                }
            );
    }

    public function save(GroupBossDTO $boss): bool
    {
        $result = $this->saveDto(new GroupBoss, $boss);
        if ($result) {
            GroupBossUpdated::dispatch();
        }

        return $result;
    }
}
