<?php

namespace App\Domain\GroupBoss\Repositories;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

interface GroupBossRepositoryContract
{
    public function findByComment(CommentDTO $comment): ?GroupBossDTO;

    public function findById(int $id): ?GroupBossDTO;

    public function save(GroupBossDTO $boss): bool;
}
