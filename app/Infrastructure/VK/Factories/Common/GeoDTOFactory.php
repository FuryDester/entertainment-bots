<?php

namespace App\Infrastructure\VK\Factories\Common;

use App\Domain\VK\Factories\Common\GeoDTOFactoryContract;
use App\Domain\VK\Factories\Common\GeoParts\CoordinatesDTOFactoryContract;
use App\Domain\VK\Factories\Common\GeoParts\PlaceDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

final readonly class GeoDTOFactory implements GeoDTOFactoryContract
{
    public static function createFromParams(int $type, CoordinatesDTO $coordinates, ?PlaceDTO $place): GeoDTO
    {
        return (new GeoDTO)
            ->setType($type)
            ->setCoordinates($coordinates)
            ->setPlace($place);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): GeoDTO
    {
        /** @var CoordinatesDTOFactoryContract $coordinatesFactory */
        $coordinatesFactory = app(CoordinatesDTOFactoryContract::class);
        /** @var PlaceDTOFactoryContract $placeFactory */
        $placeFactory = app(PlaceDTOFactoryContract::class);

        return (new GeoDTO)
            ->setType($data['type'])
            ->setCoordinates($coordinatesFactory::createFromApiData($data['coordinates']))
            ->setPlace(($data['place'] ?? null) ? $placeFactory::createFromData($data['place']) : null);
    }
}
