<?php

namespace App\Domain\VK\Factories\Common\MessageParts\ActionParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;

interface PhotoDTOFactoryContract
{
    public static function createFromParams(string $photo50, string $photo100, string $photo200): PhotoDTO;

    /**
     * @param array{
     *     photo_50: string,
     *     photo_100: string,
     *     photo_200: string,
     * } $data
     */
    public static function createFromApiData(array $data): PhotoDTO;
}
