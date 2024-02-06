<?php

namespace App\Infrastructure\VK\Factories\Common;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageContextDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

final class MessageContextDTOFactory implements MessageContextDTOFactoryContract
{
    public static function createFromParams(MessageDTO $message, ClientInfoDTO $clientInfo): MessageContextDTO
    {
        return (new MessageContextDTO())
            ->setMessage($message)
            ->setClientInfo($clientInfo);
    }
}
