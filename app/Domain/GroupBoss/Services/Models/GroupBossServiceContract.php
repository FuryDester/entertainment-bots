<?php

namespace App\Domain\GroupBoss\Services\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;

interface GroupBossServiceContract
{
    public function findByComment(CommentDTO $comment): ?GroupBossDTO;

    public function findById(int $id): ?GroupBossDTO;

    public function save(GroupBossDTO $boss): bool;

    /**
     * Вычитает здоровье у группового босса.
     * Если здоровье становится меньше 0, то устанавливает статус босса "убит".
     * Возвращает true, если здоровье было вычтено, иначе false.
     * Если босс убит этим ударом, то возвращает null.
     */
    public function subtractHealth(GroupBossDTO $boss, UserDTO $user, int $health): bool|null;
}
