<?php

namespace App\Domain\Commands\Factories\Timer;

use App\Infrastructure\Commands\DataTransferObjects\Timer\TimerJobPayloadDTO;

interface TimerJobPayloadDTOFactoryContract
{
    public static function createFromParams(
        int $vkUserId,
        int $vkPeerId,
        int $minutes,
        ?string $message
    ): TimerJobPayloadDTO;
}
