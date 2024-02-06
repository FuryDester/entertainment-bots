<?php

namespace App\Domain\VK\Factories\Common;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageContextDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

interface MessageContextDTOFactoryContract
{
    public static function createFromParams(MessageDTO $message, ClientInfoDTO $clientInfo): MessageContextDTO;
}
