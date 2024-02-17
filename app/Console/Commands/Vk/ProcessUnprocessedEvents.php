<?php

namespace App\Console\Commands\Vk;

use App\Domain\VK\Factories\Requests\CallbackRequestDTOFactoryContract;
use App\Domain\VK\Services\Actions\ActionServiceContract;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class ProcessUnprocessedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:process-unprocessed-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Повторно обрабатывает необработанные события из таблицы vk_events,'
        .' если количество попыток обработки меньше указанного в настройках приложения.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /** @var VkEventServiceContract $service */
        $service = app(VkEventServiceContract::class);

        $this->info('Start processing unprocessed events...');
        $events = $service->getUnprocessedWithAttempts(config('integrations.vk.retry'));
        if (empty($events)) {
            $this->info('No unprocessed events found.');

            return;
        }

        $this->info('Found '.count($events).' unprocessed events.');

        /** @var ActionServiceContract $actionService */
        $actionService = app(ActionServiceContract::class);
        $this->withProgressBar($events, function ($event) use ($actionService, $service) {
            $action = $actionService->getActionByDto($event);

            if (! $action) {
                $this->fullWarnLog("Action not found for event: {$event->getEventId()} with type {$event->getType()}");
                $service->delete($event->getId());
                $this->fullWarnLog(
                    "Event deleted (action not found): {$event->getEventId()} with type {$event->getType()}. Json: "
                    .json_encode($event->toArray())
                );

                return;
            }

            Log::info("Processing event: {$event->getEventId()} with type: {$event->getType()}");
            /** @var CallbackRequestDTOFactoryContract $callbackRequestFactory */
            $callbackRequestFactory = app(CallbackRequestDTOFactoryContract::class);
            try {
                $result = $action::perform($callbackRequestFactory::createFromVkEvent($event));
            } catch (\Throwable $exception) {
                Log::error('Exception occurred during event processing', [
                    'exception' => $exception,
                    'event' => $event->toArray(),
                ]);
                $result = false;
            }
            $event->setIsProcessed($result)->setAttempts($event->getAttempts() + 1);
            $service->save($event);

            $eventProcessingStatus = $result ? 'processed' : 'processing failed';
            $text = sprintf(
                'Event %s: %s with type: %s. Attempts: %s',
                $eventProcessingStatus,
                $event->getEventId(),
                $event->getType(),
                $event->getAttempts()
            );
            if (! $result) {
                $this->warn($text);
            }
            Log::{$result ? 'info' : 'warning'}($text);
        });

        $this->info('Finish processing unprocessed events.');
    }

    /**
     * Записывает лог как в Log, так и в логгер $this
     */
    protected function fullWarnLog(string $message): void
    {
        $this->warn($message);
        Log::warning($message);
    }
}
