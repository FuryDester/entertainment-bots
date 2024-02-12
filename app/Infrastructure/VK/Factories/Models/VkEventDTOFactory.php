<?php

namespace App\Infrastructure\VK\Factories\Models;

use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use Illuminate\Support\Carbon;

final class VkEventDTOFactory implements VkEventDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): VkEventDTO
    {
        return (new VkEventDTO())
            ->setId($data['id'] ?? null)
            ->setEventId($data['event_id'])
            ->setType($data['type'])
            ->setVersion($data['version'])
            ->setGroupId($data['group_id'])
            ->setObject($data['object'])
            ->setIsProcessed($data['is_processed'] ?? false)
            ->setAttempts($data['attempts'] ?? 1)
            ->setCreatedAt(($data['created_at'] ?? null) ? new Carbon($data['created_at']) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? new Carbon($data['updated_at']) : null);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromCallback(CallbackRequestDTO $dto): VkEventDTO
    {
        return (new VkEventDTO())
            ->setId(null)
            ->setEventId($dto->getEventId())
            ->setType($dto->getType())
            ->setVersion($dto->getVersion())
            ->setGroupId($dto->getGroupId())
            ->setObject(json_encode($dto->getObject()))
            ->setIsProcessed(false)
            ->setAttempts(1)
            ->setCreatedAt(null)
            ->setUpdatedAt(null);
    }
}
