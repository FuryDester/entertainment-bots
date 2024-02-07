<?php

namespace App\Infrastructure\VK\Repositories;

use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Domain\VK\Repositories\VkEventRepositoryContract;
use App\Infrastructure\Common\Traits\ArrayKeysToSneakCase;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Models\VkEvent;
use Illuminate\Support\Arr;

final class VkEventRepository implements VkEventRepositoryContract
{
    use ArrayKeysToSneakCase;

    /**
     * {@inheritDoc}
     */
    public function save(VkEventDTO $event): bool
    {
        $data = Arr::except($this->arrayKeysToSneakCase($event->toArray()), [
            'id',
            'created_at',
            'updated_at',
        ]);

        $now = now();
        if ($event->getId()) {
            return (bool) VkEvent::query()
                ->firstWhere('id', $event->getId())
                ->update([
                    ...$data,
                    'updated_at' => $now,
                ]);
        }

        $id = VkEvent::query()->insertGetId($data);
        if (!$id) {
            return false;
        }

        $event
            ->setId($id)
            ->setCreatedAt($now)
            ->setUpdatedAt($now);
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getEventByEventId(string $eventId): ?VkEventDTO
    {
        $event = VkEvent::query()->firstWhere('event_id', $eventId);
        if (!$event) {
            return null;
        }

        /** @var VkEventDTOFactoryContract $factory */
        $factory = app(VkEventDTOFactoryContract::class);
        return $factory::createFromData($event->toArray());
    }
}
