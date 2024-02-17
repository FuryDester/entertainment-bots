<?php

namespace App\Infrastructure\PayloadActions\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;

final class PayloadDTO extends AbstractDTO
{
    protected ActionStageEnum $type;

    protected ?int $id;

    protected ?array $data;

    public function getType(): ActionStageEnum
    {
        return $this->type;
    }

    public function setType(ActionStageEnum $type): PayloadDTO
    {
        $this->type = $type;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): PayloadDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): PayloadDTO
    {
        $this->data = $data;

        return $this;
    }
}
