<?php

namespace App\Domain\Common\Services\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;

interface UserServiceContract
{
    /**
     * Поиск пользователя по его VK ID и ID чата, является уникальным набором параметров
     */
    public function findByVkIdAndPeerId(int $vkId, int $peerId): ?UserDTO;

    /**
     * Сохранение или обновление пользователя (если указан id - обновление, иначе - создание)
     */
    public function save(UserDTO $user): bool;
}
