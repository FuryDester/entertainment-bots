<?php

namespace App\Infrastructure\VK\Factories\Common\GeoParts;

use App\Domain\VK\Factories\Common\GeoParts\CoordinatesDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;

final readonly class CoordinatesDTOFactory implements CoordinatesDTOFactoryContract
{
    public static function createFromParams(float $latitude, float $longitude): CoordinatesDTO
    {
        return (new CoordinatesDTO)
            ->setLatitude($latitude)
            ->setLongitude($longitude);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): CoordinatesDTO
    {
        return self::createFromParams($data['latitude'], $data['longitude']);
    }
}
