<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

final class MessageContextDTO extends BaseDTO
{
    protected MessageDTO $message;

    protected ClientInfoDTO $clientInfo;

    public function getMessage(): MessageDTO
    {
        return $this->message;
    }

    public function setMessage(MessageDTO $message): MessageContextDTO
    {
        $this->message = $message;
        return $this;
    }

    public function getClientInfo(): ClientInfoDTO
    {
        return $this->clientInfo;
    }

    public function setClientInfo(ClientInfoDTO $clientInfo): MessageContextDTO
    {
        $this->clientInfo = $clientInfo;
        return $this;
    }
}
