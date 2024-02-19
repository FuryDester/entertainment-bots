<?php

namespace App\Domain\GroupBoss\Repositories;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;

interface GroupBossUserActionRepositoryContract
{
    /**
     * Поиск последнего действия пользователя по групповому боссу.
     */
    public function findLastActionByUserAndBoss(UserDTO $user, GroupBossDTO $boss): ?GroupBossUserActionDTO;

    public function save(GroupBossUserActionDTO $action): bool;
}
