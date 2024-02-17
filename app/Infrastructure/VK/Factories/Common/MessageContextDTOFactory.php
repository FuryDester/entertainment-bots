<?php

namespace App\Infrastructure\VK\Factories\Common;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ClientInfoDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\MessageDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageContextDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

final class MessageContextDTOFactory implements MessageContextDTOFactoryContract
{
    public static function createFromParams(MessageDTO $message, ClientInfoDTO $clientInfo): MessageContextDTO
    {
        return (new MessageContextDTO)
            ->setMessage($message)
            ->setClientInfo($clientInfo);
    }

    public static function createFromApiData(array $data): MessageContextDTO
    {
        /** @var ClientInfoDTOFactoryContract $clientInfoFactory */
        $clientInfoFactory = app(ClientInfoDTOFactoryContract::class);
        /** @var MessageDTOFactoryContract $messageFactory */
        $messageFactory = app(MessageDTOFactoryContract::class);

        return (new MessageContextDTO)
            ->setClientInfo($clientInfoFactory::createFromApiData($data['client_info']))
            ->setMessage($messageFactory::createFromApiData($data['message']));
    }
}
