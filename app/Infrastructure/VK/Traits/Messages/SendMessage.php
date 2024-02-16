<?php

namespace App\Infrastructure\VK\Traits\Messages;

use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;

trait SendMessage
{
    /**
     * Отправка сообщения ВК
     */
    protected function sendMessage(int $peerId, string $message, array $options = []): void
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $vkClient = new VKApiClient();
        try {
            $vkClient->messages()->send($accessToken->getAccessToken(), [
                'message' => $message,
                'peer_id' => $peerId,
                'random_id' => rand(0, 10000000),
                ...$options,
            ]);
        } catch (\Throwable $exception) {
            Log::warning('Failed to send message', [
                'peer_id' => $peerId,
                'message' => $message,
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }
}
