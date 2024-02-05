<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;

interface PhotoDTOFactoryContract
{
    public static function createFromParams(string $photo50, string $photo100, string $photo200): PhotoDTO;
}
