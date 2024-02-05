<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\GeoParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

final class CoordinatesDTO extends BaseDTO
{
    protected float $latitude;

    protected float $longitude;

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): CoordinatesDTO
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): CoordinatesDTO
    {
        $this->longitude = $longitude;
        return $this;
    }
}
