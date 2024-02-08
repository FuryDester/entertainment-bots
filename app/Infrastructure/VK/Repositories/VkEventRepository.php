<?php

namespace App\Infrastructure\VK\Repositories;

use App\Domain\VK\Factories\Models\VkEventDTOFactoryContract;
use App\Domain\VK\Repositories\VkEventRepositoryContract;
use App\Events\Vk\VkEventUpdated;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\ArrayKeysToSneakCase;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\Enums\Cache\VkCacheEnum;
use App\Models\VK\VkEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

final class VkEventRepository implements VkEventRepositoryContract
{
    use ArrayKeysToSneakCase;
    use FormBaseCacheKey;

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
            $result = (bool) VkEvent::query()
                ->firstWhere('id', $event->getId())
                ->update([
                    ...$data,
                    'updated_at' => $now,
                ]);

            if ($result) {
                $event->setUpdatedAt($now);
                VkEventUpdated::dispatch();
            }

            return $result;
        }

        $id = VkEvent::query()->insertGetId([
            ...$data,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        if (!$id) {
            return false;
        }

        $event
            ->setId($id)
            ->setCreatedAt($now)
            ->setUpdatedAt($now);
        VkEventUpdated::dispatch();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getEventByEventId(string $eventId): ?VkEventDTO
    {
        $event = Cache::tags(VkCacheEnum::VkEventRepository->value)->remember(
            $this->formBaseCacheKey($eventId),
            CacheTimeEnum::DAY->value,
            static function () use ($eventId) {
                return VkEvent::query()->firstWhere('event_id', $eventId);
            },
        );

        if (!$event) {
            return null;
        }

        /** @var VkEventDTOFactoryContract $factory */
        $factory = app(VkEventDTOFactoryContract::class);
        return $factory::createFromData($event->toArray());
    }

    /**
     * {@inheritDoc}
     */
    public function removeOldEvents(int $days, bool $processed): int
    {
        $result = VkEvent::query()
            ->where('created_at', '<', now()->subDays($days))
            ->where('is_processed', $processed)
            ->delete();

        if ($result) {
            VkEventUpdated::dispatch();
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getUnprocessedWithAttempts(int $maxAttempts): array
    {
        $events = Cache::tags(VkCacheEnum::VkEventRepository->value)->remember(
            $this->formBaseCacheKey($maxAttempts),
            CacheTimeEnum::HOUR->value,
            static function () use ($maxAttempts) {
                return VkEvent::query()
                    ->where('is_processed', false)
                    ->where('attempts', '<', $maxAttempts)
                    ->get();
            },
        );

        /** @var VkEventDTOFactoryContract $factory */
        $factory = app(VkEventDTOFactoryContract::class);
        return $events->map(
            static fn (VkEvent $event) => $factory::createFromData($event->toArray())
        )->all();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): bool
    {
        $result = (bool) VkEvent::query()->where('id', $id)->delete();
        if ($result) {
            VkEventUpdated::dispatch();
        }

        return $result;
    }
}
