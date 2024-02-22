<?php

namespace App\Application\Common\Services\Models;

use App\Domain\Common\Repositories\UserActionRepositoryContract;
use App\Domain\Common\Services\Models\UserActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;

final readonly class UserActionService implements UserActionServiceContract
{
    public function __construct(
        private UserActionRepositoryContract $repository,
    ) {
    }

    public function save(UserActionDTO $action): bool
    {
        return $this->repository->save($action);
    }

    /**
     * {@inheritDoc}
     */
    public function getActiveActionsByUser(UserDTO $user, ?array $aliases = []): array
    {
        return $this->repository->getActiveActionsByUser($user, $aliases);
    }
}
