<?php

namespace App\Application\VK\Services\Actions;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actionable;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;

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

        // TODO: Remove after testing
        if (mt_rand(0, 20) === 0 && $message->getText()) {
            Log::info('MessageNewAction: random success');
            /** @var AccessTokenDTO $accessToken */
            $accessToken = app(AccessTokenDTO::class);

            $client = new VKApiClient();
            $client->messages()->send($accessToken->getAccessToken(), [
                'peer_id' => $message->getPeerId(),
                'message' => 'Попка попугай повторяет: ' . $message->getText(),
                'random_id' => mt_rand(0, 1000000),
            ]);
        }

        return true;
    }
}
