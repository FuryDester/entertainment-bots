<?php

namespace App\Domain\GroupBoss\Services;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

interface GroupBossExecutorContract
{
    /**
     * @return bool Успешность обработки. Если групповой босс не был обработан, то false, иначе true.
     */
    public function execute(CommentDTO $comment, UserDTO $user, GroupBossDTO $boss): bool;
}
