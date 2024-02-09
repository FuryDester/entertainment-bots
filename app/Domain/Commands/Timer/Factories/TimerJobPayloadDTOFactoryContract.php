<?php

namespace App\Domain\Commands\Timer\Factories;

use App\Infrastructure\Commands\Timer\DataTransferObjects\TimerJobPayloadDTO;

interface TimerJobPayloadDTOFactoryContract
{
    public function createFromParams(
        int $vkUserId,
        int $vkPeerId,
        int $minutes,
        ?string $message
    ): TimerJobPayloadDTO;
}
