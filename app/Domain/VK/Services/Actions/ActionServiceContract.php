<?php

namespace App\Domain\VK\Services\Actions;

use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;

interface ActionServiceContract
{
    /**
     * Получение действия по имени. Если действие не найдено, возвращает null.
     */
    public function getActionByDto(VkEventDTO $dto): ?Actionable;
}
