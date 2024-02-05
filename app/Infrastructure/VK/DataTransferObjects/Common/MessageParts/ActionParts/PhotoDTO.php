<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

final class PhotoDTO extends BaseDTO
{
    protected string $photo50;

    protected string $photo100;

    protected string $photo200;

    public function getPhoto50(): string
    {
        return $this->photo50;
    }

    public function setPhoto50(string $photo50): PhotoDTO
    {
        $this->photo50 = $photo50;
        return $this;
    }

    public function getPhoto100(): string
    {
        return $this->photo100;
    }

    public function setPhoto100(string $photo100): PhotoDTO
    {
        $this->photo100 = $photo100;
        return $this;
    }

    public function getPhoto200(): string
    {
        return $this->photo200;
    }

    public function setPhoto200(string $photo200): PhotoDTO
    {
        $this->photo200 = $photo200;
        return $this;
    }
}
