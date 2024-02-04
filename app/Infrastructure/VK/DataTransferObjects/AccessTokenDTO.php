<?php

namespace App\Infrastructure\VK\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

class AccessTokenDTO extends BaseDTO
{
    protected string $accessToken;

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): AccessTokenDTO
    {
        $this->accessToken = $accessToken;
        return $this;
    }
}
