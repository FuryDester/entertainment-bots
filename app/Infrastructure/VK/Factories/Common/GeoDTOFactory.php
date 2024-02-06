<?php

namespace App\Infrastructure\VK\Factories\Common;

use App\Domain\VK\Factories\Common\GeoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

final class GeoDTOFactory implements GeoDTOFactoryContract
{
    public static function createFromParams(int $type, CoordinatesDTO $coordinates, ?PlaceDTO $place): GeoDTO
    {
        return (new GeoDTO())
            ->setType($type)
            ->setCoordinates($coordinates)
            ->setPlace($place);
    }
}
