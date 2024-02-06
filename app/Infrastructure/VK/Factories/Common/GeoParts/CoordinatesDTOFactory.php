<?php

namespace App\Infrastructure\VK\Factories\Common\GeoParts;

use App\Domain\VK\Factories\Common\GeoParts\CoordinatesDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;

final class CoordinatesDTOFactory implements CoordinatesDTOFactoryContract
{
    public static function createFromParams(float $latitude, float $longitude): CoordinatesDTO
    {
        return (new CoordinatesDTO())
            ->setLatitude($latitude)
            ->setLongitude($longitude);
    }
}
