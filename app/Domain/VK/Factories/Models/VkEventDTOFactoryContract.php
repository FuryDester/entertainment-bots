<?php

namespace App\Domain\VK\Factories\Models;

use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use Illuminate\Support\Carbon;

interface VkEventDTOFactoryContract
{
    /**
     * @param array{
     *     id: int|null,
     *     event_id: string,
     *     type: string,
     *     version: string,
     *     group_id: int,
     *     object: string,
     *     is_processed: bool|null,
     *     attempts: int|null,
     *     created_at: Carbon|null,
     *     updated_at: Carbon|null,
     * } $data
     */
    public static function createFromData(array $data): VkEventDTO;

    /**
     * Создание объекта события из данных обратного вызова.
     */
    public static function createFromCallback(CallbackRequestDTO $dto): VkEventDTO;
}
