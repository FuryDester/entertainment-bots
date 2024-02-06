<?php

namespace App\Domain\VK\Factories\Common\GeoParts;

use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

interface PlaceDTOFactoryContract
{
    /**
     * @param array{
     *     id: int,
     *     title: string|null,
     *     latitude: float|null,
     *     longitude: float|null,
     *     created: int|null,
     *     icon: string|null,
     *     country: int,
     *     city: string,
     *     type: int|null,
     *     group_id: int|null,
     *     group_photo: string|null,
     *     checkins: int|null,
     *     updated: int|null,
     *     address: int|null,
     * } $data
     */
    public static function createFromData(array $data): PlaceDTO;
}
