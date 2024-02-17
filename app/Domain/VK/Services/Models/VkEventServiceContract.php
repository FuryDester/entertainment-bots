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

    /**
     * Удаление событий, которые были созданы более $days дней назад.
     * Возвращает количество удаленных событий.
     *
     * @param  int  $days  Количество дней, после которых события будут удалены.
     * @param  bool  $processed  Если true, то будут удалены только обработанные события, иначе - только необработанные.
     */
    public function removeOldEvents(int $days, bool $processed): int;

    /**
     * Получение необработанных событий, у которых количество попыток обработки меньше $maxAttempts.
     *
     * @param  int  $maxAttempts  Максимальное количество попыток обработки.
     * @return VkEventDTO[]
     */
    public function getUnprocessedWithAttempts(int $maxAttempts): array;

    /**
     * Удаление события по его ID.
     *
     * @return bool Успешно ли удаление.
     */
    public function delete(int $id): bool;
}
