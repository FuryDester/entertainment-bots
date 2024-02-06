<?php

namespace App\Domain\VK\Factories\Common;

use App\Infrastructure\VK\DataTransferObjects\Common\GeoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

interface GeoDTOFactoryContract
{
    public static function createFromParams(int $type, CoordinatesDTO $coordinates, ?PlaceDTO $place): GeoDTO;

    /**
     * @param array{
     *     type: int,
     *     coordinates: array,
     *     place: array|null,
     * } $data
     */
    public static function createFromApiData(array $data): GeoDTO;
}
