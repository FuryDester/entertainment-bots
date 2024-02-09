<?php

namespace App\Infrastructure\Commands\Timer\Factories;

use App\Domain\Commands\Timer\Factories\TimerJobPayloadDTOFactoryContract;
use App\Infrastructure\Commands\Timer\DataTransferObjects\TimerJobPayloadDTO;

final class TimerJobPayloadDTOFactory implements TimerJobPayloadDTOFactoryContract
{
    public function createFromParams(int $vkUserId, int $vkPeerId, int $minutes, ?string $message): TimerJobPayloadDTO
    {
        return (new TimerJobPayloadDTO())
            ->setVkUserId($vkUserId)
            ->setVkPeerId($vkPeerId)
            ->setMinutes($minutes)
            ->setMessage($message);
    }
}
