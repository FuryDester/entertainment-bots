<?php

namespace App\Application\GroupBoss\Services\Models;

use App\Domain\GroupBoss\Repositories\GroupBossWeaponRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossWeaponServiceContract;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

final readonly class GroupBossWeaponService implements GroupBossWeaponServiceContract
{
    public function __construct(
        private GroupBossWeaponRepositoryContract $repository,
    ) {
    }

    public function getWeaponNameByCommentAndBoss(GroupBossDTO $boss, CommentDTO $comment): ?GroupBossWeaponDTO
    {
        if (! $text = $comment->getText()) {
            return null;
        }

        return $this->repository->getWeaponByNameAndBoss($boss, $text);
    }
}
