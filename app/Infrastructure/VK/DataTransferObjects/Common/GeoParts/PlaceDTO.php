<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\GeoParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

final class PlaceDTO extends BaseDTO
{
    protected int $id;

    protected ?string $title;

    protected ?float $latitude;

    protected ?float $longitude;

    protected ?int $created;

    protected ?string $icon;

    protected int $country;

    protected string $city;

    protected ?int $type;

    protected ?int $groupId;

    protected ?string $groupPhoto;

    protected ?int $checkins;

    protected ?int $updated;

    protected ?int $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): PlaceDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): PlaceDTO
    {
        $this->title = $title;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): PlaceDTO
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): PlaceDTO
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getCreated(): ?int
    {
        return $this->created;
    }

    public function setCreated(?int $created): PlaceDTO
    {
        $this->created = $created;
        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): PlaceDTO
    {
        $this->icon = $icon;
        return $this;
    }

    public function getCountry(): int
    {
        return $this->country;
    }

    public function setCountry(int $country): PlaceDTO
    {
        $this->country = $country;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): PlaceDTO
    {
        $this->city = $city;
        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): PlaceDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(?int $groupId): PlaceDTO
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function getGroupPhoto(): ?string
    {
        return $this->groupPhoto;
    }

    public function setGroupPhoto(?string $groupPhoto): PlaceDTO
    {
        $this->groupPhoto = $groupPhoto;
        return $this;
    }

    public function getCheckins(): ?int
    {
        return $this->checkins;
    }

    public function setCheckins(?int $checkins): PlaceDTO
    {
        $this->checkins = $checkins;
        return $this;
    }

    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    public function setUpdated(?int $updated): PlaceDTO
    {
        $this->updated = $updated;
        return $this;
    }

    public function getAddress(): ?int
    {
        return $this->address;
    }

    public function setAddress(?int $address): PlaceDTO
    {
        $this->address = $address;
        return $this;
    }
}
