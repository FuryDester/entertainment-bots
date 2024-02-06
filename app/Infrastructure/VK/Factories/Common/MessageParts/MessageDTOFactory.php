<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\MessageDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

final class MessageDTOFactory implements MessageDTOFactoryContract
{
    public static function createFromData(array $data): MessageDTO
    {
        return (new MessageDTO());
    }
}
