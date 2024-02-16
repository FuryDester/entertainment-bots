<?php

namespace App\Infrastructure\PayloadActions;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use Illuminate\Support\Facades\Log;

abstract class AbstractPayloadAction
{
    abstract public function getActionName(): ActionStageEnum;

    /**
     * @return ActionStageEnum[]
     */
    abstract public function getPossibleActions(): array;

    public function run(MessageDTO $message, PayloadDTO $payload, UserDTO $user): bool
    {
        Log::info('Running action', [
            'action' => $this->getActionName(),
            'payload' => $payload->toArray(),
            'message' => $message->toArray(),
            'user' => $user->toArray(),
        ]);

        $result = $this->execute($message, $payload, $user);

        Log::info('Action executed', [
            'action' => $this->getActionName(),
            'message' => $message->toArray(),
            'user' => $user->toArray(),
            'payload' => $payload->toArray(),
            'result' => $result,
        ]);

        return $result;
    }

    abstract protected function execute(MessageDTO $message, PayloadDTO $payload, UserDTO $user): bool;
}
