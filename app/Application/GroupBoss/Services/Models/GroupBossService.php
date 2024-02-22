<?php

namespace App\Application\GroupBoss\Services\Models;

use App\Domain\GroupBoss\Repositories\GroupBossRepositoryContract;
use App\Domain\GroupBoss\Services\Models\GroupBossServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

final readonly class GroupBossService implements GroupBossServiceContract
{
    public function __construct(
        protected GroupBossRepositoryContract $repository,
    ) {
    }

    public function findByComment(CommentDTO $comment): ?GroupBossDTO
    {
        return $this->repository->findByComment($comment);
    }

    public function findById(int $id): ?GroupBossDTO
    {
        return $this->repository->findById($id);
    }

    public function save(GroupBossDTO $boss): bool
    {
        return $this->repository->save($boss);
    }

    /**
     * {@inheritDoc}
     */
    public function subtractHealth(GroupBossDTO $boss, UserDTO $user, int $health): ?bool
    {
        $newBoss = $this->repository->findById($boss->getId());
        if (! $newBoss) {
            return false;
        }

        $newBoss->setCurrentHealth(max(0, $newBoss->getCurrentHealth() - $health));
        $isDead = $newBoss->getCurrentHealth() <= 0;
        if ($isDead) {
            $newBoss
                ->setKilledBy($user->getId())
                ->setKilledAt(now());
        }

        $result = $this->repository->save($newBoss);

        return $isDead ? null : $result;
    }
}
