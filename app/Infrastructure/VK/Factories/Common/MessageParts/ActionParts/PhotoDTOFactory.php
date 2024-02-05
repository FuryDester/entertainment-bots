<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts\ActionParts;

use App\Domain\VK\Factories\Common\MessageParts\PhotoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;

class PhotoDTOFactory implements PhotoDTOFactoryContract
{
    public static function createFromParams(string $photo50, string $photo100, string $photo200): PhotoDTO
    {
        return (new PhotoDTO())
            ->setPhoto50($photo50)
            ->setPhoto100($photo100)
            ->setPhoto200($photo200);
    }
}
