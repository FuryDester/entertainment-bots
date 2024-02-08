<?php

namespace App\Console\Commands\Vk;

use App\Domain\VK\Services\Models\VkEventServiceContract;
use Illuminate\Console\Command;

final class RemoveOldEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:remove-old-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет старые необработанные события из таблицы vk_events, а также обработанные события, которые были обработаны более 7 дней назад.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Start removing old events...');

        /** @var VkEventServiceContract $vkEventService */
        $vkEventService = app(VkEventServiceContract::class);

        $processedCount = $vkEventService->removeOldEvents(7, true);
        $this->info("Removed $processedCount processed events.");

        $unprocessedCount = $vkEventService->removeOldEvents(1, false);
        $this->info("Removed $unprocessedCount unprocessed events.");

        $this->info('Finish removing old events.');
    }
}
