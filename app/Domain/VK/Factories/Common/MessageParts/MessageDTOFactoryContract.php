<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

interface MessageDTOFactoryContract
{
    public static function createFromData(array $data): MessageDTO;
}
