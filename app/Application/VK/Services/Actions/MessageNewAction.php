<?php

namespace App\Application\VK\Services\Actions;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actionable;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Illuminate\Support\Facades\Log;

final class MessageNewAction implements Actionable
{
    public static function getActionName(): ActionEnum
    {
        return ActionEnum::MessageNew;
    }

    public static function perform(CallbackRequestDTO $data): bool
    {
        /** @var MessageContextDTOFactoryContract $messageContextFactory */
        $messageContextFactory = app(MessageContextDTOFactoryContract::class);

        $messageContext = $messageContextFactory::createFromApiData($data->getObject());
        $message = $messageContext->getMessage();
        Log::info(sprintf(
            'MessageNewAction from id: %d, peerId: %d, text: %s',
            $message->getFromId(),
            $message->getPeerId(),
            $message->getText() ?: 'empty message text'
        ));

        return true;
    }
}
