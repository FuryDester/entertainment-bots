<?php

namespace App\Jobs\Commands\Timer;

use App\Infrastructure\Commands\DataTransferObjects\Timer\TimerJobPayloadDTO;
use App\Infrastructure\Common\Traits\WordDeclension;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\Traits\Common\MentionUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;

final class ProcessTimerCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use MentionUser;
    use WordDeclension;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public TimerJobPayloadDTO $payload,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $vkClient = new VKApiClient();

        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        try {
            $mention = $this->getMentionByUserId($this->payload->getVkUserId());
        } catch (\Throwable) {
            $mention = $this->formMention($this->payload->getVkUserId());
        }

        $text = sprintf(
            '%s, таймер на %d %s завершен.%s',
            $mention,
            $this->payload->getMinutes(),
            $this->declension($this->payload->getMinutes(), ['минуту', 'минуты', 'минут']),
            $this->payload->getMessage() ? (' Текст: ' . $this->payload->getMessage()) : '',
        );
        try {
            $vkClient->messages()->send($accessToken->getAccessToken(), [
                'message' => $text,
                'peer_id' => $this->payload->getVkPeerId(),
                'random_id' => rand(0, 1000000),
                'disable_mentions' => 0,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to send timer message to user', [
                'error' => $e->getMessage(),
                'payload' => $this->payload->toArray(),
            ]);
            $this->fail($e);
        }
    }
}
