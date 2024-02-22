<?php

namespace App\Application\GroupBoss\Services\Models;

use App\Domain\GroupBoss\Repositories\GroupBossUserActionRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossUserActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;

final readonly class GroupBossUserActionService implements GroupBossUserActionServiceContract
{
    public function __construct(
        private GroupBossUserActionRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function findLastActionByUserAndBoss(UserDTO $user, GroupBossDTO $boss): ?GroupBossUserActionDTO
    {
        return $this->repository->findLastActionByUserAndBoss($user, $boss);
    }

    public function save(GroupBossUserActionDTO $action): bool
    {
        return $this->repository->save($action);
    }
}
