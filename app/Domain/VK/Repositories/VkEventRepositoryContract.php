<?php

namespace App\Domain\VK\Repositories;

use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;

interface VkEventRepositoryContract
{
    /**
     * Сохранение или обновление события в базе данных. Тип действия определяется наличием ID события (id).
     */
    public function save(VkEventDTO $event): bool;

    /**
     * Получение события по его event_id. Возвращает null, если событие не найдено.
     */
    public function getEventByEventId(string $eventId): ?VkEventDTO;
}
