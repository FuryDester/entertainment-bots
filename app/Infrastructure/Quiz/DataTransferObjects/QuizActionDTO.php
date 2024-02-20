<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Carbon;

final class QuizActionDTO extends AbstractDTO
{
    protected ?int $id;

    protected ActionAliasTypeEnum $alias;

    protected ActionTypeEnum $type;

    protected ?array $data;

    protected ?int $duration;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizActionDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getAlias(): ActionAliasTypeEnum
    {
        return $this->alias;
    }

    public function setAlias(ActionAliasTypeEnum $alias): QuizActionDTO
    {
        $this->alias = $alias;
        return $this;
    }

    public function getType(): ActionTypeEnum
    {
        return $this->type;
    }

    public function setType(ActionTypeEnum $type): QuizActionDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): QuizActionDTO
    {
        $this->data = $data;
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): QuizActionDTO
    {
        $this->duration = $duration;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizActionDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizActionDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
