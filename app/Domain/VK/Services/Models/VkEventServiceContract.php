<?php

namespace App\Domain\VK\Services\Models;

use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;

interface VkEventServiceContract
{
    /**
     * Сохранение или обновление события в базе данных. Тип действия определяется наличием ID события (id).
     */
    public function save(VkEventDTO $event): bool;

    /**
     * Получение события по его ID. Возвращает null, если событие не найдено.
     * Идентификатор события берется из поля eventId.
     */
    public function getEventByEventId(string $eventId): ?VkEventDTO;
}
