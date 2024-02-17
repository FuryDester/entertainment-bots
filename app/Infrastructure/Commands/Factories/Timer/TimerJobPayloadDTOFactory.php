<?php

namespace App\Infrastructure\Commands\Factories\Timer;

use App\Domain\Commands\Factories\Timer\TimerJobPayloadDTOFactoryContract;
use App\Infrastructure\Commands\DataTransferObjects\Timer\TimerJobPayloadDTO;

final class TimerJobPayloadDTOFactory implements TimerJobPayloadDTOFactoryContract
{
    public static function createFromParams(
        int $vkUserId,
        int $vkPeerId,
        int $minutes,
        ?string $message
    ): TimerJobPayloadDTO {
        return (new TimerJobPayloadDTO)
            ->setVkUserId($vkUserId)
            ->setVkPeerId($vkPeerId)
            ->setMinutes($minutes)
            ->setMessage($message);
    }
}
