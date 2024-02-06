<?php

namespace App\Domain\VK\Factories\Common\GeoParts;

use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;

interface CoordinatesDTOFactoryContract
{
    public static function createFromParams(float $latitude, float $longitude): CoordinatesDTO;

    /**
     * @param array{
     *     latitude: float,
     *     longitude: float,
     * } $data
     */
    public static function createFromApiData(array $data): CoordinatesDTO;
}
