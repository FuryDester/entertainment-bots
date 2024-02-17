<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts\ActionParts;

use App\Domain\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;

final readonly class PhotoDTOFactory implements PhotoDTOFactoryContract
{
    public static function createFromParams(string $photo50, string $photo100, string $photo200): PhotoDTO
    {
        return (new PhotoDTO)
            ->setPhoto50($photo50)
            ->setPhoto100($photo100)
            ->setPhoto200($photo200);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): PhotoDTO
    {
        return self::createFromParams($data['photo_50'], $data['photo_100'], $data['photo_200']);
    }
}
