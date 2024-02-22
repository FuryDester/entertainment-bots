<?php

namespace App\Domain\GroupBoss\Services\Models;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

interface GroupBossWeaponServiceContract
{
    public function getWeaponNameByCommentAndBoss(GroupBossDTO $boss, CommentDTO $comment): ?GroupBossWeaponDTO;
}
