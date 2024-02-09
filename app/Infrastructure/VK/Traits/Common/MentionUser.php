<?php

namespace App\Infrastructure\VK\Traits\Common;

use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

trait MentionUser
{
    protected function formMention(int $userId, string $name = ''): string
    {
        $finalName = $name ?: 'Пользователь';
        return "[id$userId|$finalName]";
    }

    /**
     * @throws VKApiException
     * @throws VKClientException
     */
    protected function getMentionByUserId(int $userId): string
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $client = new VKApiClient();
        $info = $client->users()->get($accessToken->getAccessToken(), [
            'user_ids' => $userId,
        ]);

        if (!isset($info[0])) {
            Log::warning('User not found', [
                'user_id' => $userId,
                'class' => __CLASS__,
            ]);
        }

        return $this->formMention($userId, $info[0]['first_name'] ?? '');
    }
}
