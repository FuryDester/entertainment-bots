<?php

namespace App\Application\PayloadActions\Services;

use App\Domain\PayloadActions\PayloadActionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use Illuminate\Support\Facades\Log;

final class PayloadActionService implements PayloadActionServiceContract
{
    public function canHandle(string $actionName, UserDTO $user): bool
    {
        $actions = config('app.payload_workers');
        $action = $actions[$actionName] ?? null;
        if (! $action) {
            Log::error('Action not found', [
                'action' => $actionName,
                'user' => $user->toArray(),
            ]);

            return false;
        }

        /** @var AbstractPayloadAction $actionClass */
        $actionClass = app($action);
        $state = $user->getState();

        return in_array($state, $actionClass->getPossibleActions(), true);
    }

    public function getActionByPayload(PayloadDTO $payload): ?AbstractPayloadAction
    {
        $actions = config('app.payload_workers');
        $actionType = $payload->getType();

        $action = $actions[$actionType->value] ?? null;
        if (! $action) {
            Log::warning('Invalid action in payload found', [
                'action' => $actionType->value,
                'payload' => $payload->toArray(),
            ]);

            return null;
        }

        return app($action);
    }
}
