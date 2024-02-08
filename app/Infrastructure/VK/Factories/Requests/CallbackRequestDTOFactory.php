<?php

namespace App\Infrastructure\VK\Factories\Requests;

use App\Domain\VK\Factories\Requests\CallbackRequestDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;

final class CallbackRequestDTOFactory implements CallbackRequestDTOFactoryContract
{
    public static function createFromRequest(array $data): CallbackRequestDTO
    {
        return (new CallbackRequestDTO())
            ->setType($data['type'])
            ->setEventId($data['event_id'])
            ->setVersion($data['v'])
            ->setObject($data['object'])
            ->setGroupId((int) $data['group_id'])
            ->setSecret($data['secret'] ?? null);
    }

    public static function createFromVkEvent(VkEventDTO $dto): CallbackRequestDTO
    {
        return (new CallbackRequestDTO())
            ->setType($dto->getType())
            ->setEventId($dto->getEventId())
            ->setVersion($dto->getVersion())
            ->setObject(json_decode($dto->getObject(), true))
            ->setGroupId($dto->getGroupId())
            ->setSecret(null);
    }
}
