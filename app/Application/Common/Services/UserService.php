<?php

namespace App\Application\Common\Services;

use App\Domain\Common\Repositories\UserRepositoryContract;
use App\Domain\Common\Services\UserServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;

final readonly class UserService implements UserServiceContract
{
    public function __construct(
        protected UserRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function findByVkIdAndPeerId(int $vkId, int $peerId): ?UserDTO
    {
        return $this->repository->findByVkIdAndPeerId($vkId, $peerId);
    }

    /**
     * {@inheritDoc}
     */
    public function save(UserDTO $user): bool
    {
        return $this->repository->save($user);
    }
}
