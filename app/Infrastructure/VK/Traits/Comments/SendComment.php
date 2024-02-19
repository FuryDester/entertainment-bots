<?php

namespace App\Infrastructure\VK\Traits\Comments;

use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Support\Facades\Log;
use Throwable;
use VK\Client\VKApiClient;

trait SendComment
{
    private function sendComment(int $ownerId, int $postId, string $message, array $additionalData = []): void
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $vkClient = new VKApiClient;
        try {
            $vkClient->wall()->createComment($accessToken->getAccessToken(), [
                'owner_id' => $ownerId,
                'post_id' => $postId,
                'message' => $message,
                ...$additionalData,
            ]);
        } catch (Throwable $exception) {
            Log::warning('Failed to send comment', [
                'owner_id' => $ownerId,
                'post_id' => $postId,
                'message' => $message,
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }
}
