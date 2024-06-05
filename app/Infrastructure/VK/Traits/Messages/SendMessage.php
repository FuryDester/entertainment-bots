<?php

namespace App\Infrastructure\VK\Traits\Messages;

use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;

// TODO: Write own VK php library (or one based on this)
// Official one is dead (Plus has critical bug: https://github.com/VKCOM/vk-php-sdk/issues/113)
trait SendMessage
{
    private const string API_VERSION = '5.141';
    private const string API_HOST = 'https://api.vk.com/method';

    /**
     * Отправка сообщения ВК
     */
    protected function sendMessage(int $peerId, string $message, array $options = [], bool $useVkPackage = true): void
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $vkClient = new VKApiClient;
        try {
            $params = [
                'message' => $message,
                'peer_id' => $peerId,
                'random_id' => rand(0, 10000000),
                ...$options,
            ];

            if ($useVkPackage) {
                $vkClient->messages()->send($accessToken->getAccessToken(), $params);

                return;
            }

            $result = Http::asForm()->post(self::API_HOST . '/messages.send', [
                ...$params,
                'access_token' => $accessToken->getAccessToken(),
                'v' => self::API_VERSION,
            ]);

            Log::warning('Own sent API response', [
                'status' => $result->status(),
                'json' => $result->json(),
                'body' => $result->body(),
                'failed' => $result->failed(),
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
