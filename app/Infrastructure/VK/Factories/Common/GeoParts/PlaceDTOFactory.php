<?php

namespace App\Infrastructure\VK\Factories\Common\GeoParts;

use App\Domain\VK\Factories\Common\GeoParts\PlaceDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

final class PlaceDTOFactory implements PlaceDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): PlaceDTO
    {
        return (new PlaceDTO())
            ->setId($data['id'])
            ->setTitle($data['title'] ?? null)
            ->setLatitude($data['latitude'] ?? null)
            ->setLongitude($data['longitude'] ?? null)
            ->setCreated($data['created'] ?? null)
            ->setIcon($data['icon'] ?? null)
            ->setCheckins($data['checkins'] ?? null)
            ->setUpdated($data['updated'] ?? null)
            ->setType($data['type'] ?? null)
            ->setCountry($data['country'])
            ->setCity($data['city'])
            ->setAddress($data['address'] ?? null)
            ->setGroupId($data['group_id'] ?? null)
            ->setGroupPhoto($data['group_photo'] ?? null);
    }
}
