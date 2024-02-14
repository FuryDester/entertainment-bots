<?php

namespace App\Domain\PayloadActions;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;

interface PayloadActionServiceContract
{
    public function canHandle(string $actionName, UserDTO $user): bool;

    public function getActionByPayload(PayloadDTO $payload): ?AbstractPayloadAction;
}
