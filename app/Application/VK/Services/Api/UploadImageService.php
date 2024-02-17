<?php

namespace App\Application\VK\Services\Api;

use App\Domain\VK\Services\Api\UploadImageServiceContract;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;
use VK\Client\VKApiClient;

final class UploadImageService implements UploadImageServiceContract
{
    /**
     * {@inheritDoc}
     */
    public function uploadImage(string $path): string
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $apiClient = new VKApiClient;
        try {
            $uploadServer = $apiClient->photos()->getMessagesUploadServer($accessToken->getAccessToken());
        } catch (Throwable $exception) {
            Log::warning('Failed to get upload server', [
                'exception_message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return '';
        }

        $uploadUrl = $uploadServer['upload_url'];
        $uploadResult = Http::retry(3, 100)
            ->asMultipart()
            ->post($uploadUrl, [
                'photo' => '@'.storage_path($path),
            ]);

        if (! $uploadResult->successful()) {
            Log::warning('Failed to upload image', [
                'response' => $uploadResult->json(),
            ]);

            return '';
        }

        try {
            $photo = $apiClient->photos()->saveMessagesPhoto($accessToken->getAccessToken(), $uploadResult->json());
        } catch (\Throwable $exception) {
            Log::warning('Failed to save photo', [
                'exception_message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            $photo = [];
        }

        return $photo ? "photo{$photo[0]['owner_id']}_{$photo[0]['id']}" : '';
    }
}
