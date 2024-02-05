<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\CoordinatesDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\GeoParts\PlaceDTO;

final class GeoDTO extends BaseDTO
{
    protected int $type;

    protected CoordinatesDTO $coordinates;

    protected ?PlaceDTO $place;

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): GeoDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getCoordinates(): CoordinatesDTO
    {
        return $this->coordinates;
    }

    public function setCoordinates(CoordinatesDTO $coordinates): GeoDTO
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    public function getPlace(): ?PlaceDTO
    {
        return $this->place;
    }

    public function setPlace(?PlaceDTO $place): GeoDTO
    {
        $this->place = $place;
        return $this;
    }
}
