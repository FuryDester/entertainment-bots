<?php

namespace App\Application\VK\Services\Models;

use App\Domain\VK\Repositories\VkEventRepositoryContract;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;

final class VkEventService implements VkEventServiceContract
{
    public function __construct(protected VkEventRepositoryContract $repository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function save(VkEventDTO $event): bool
    {
        return $this->repository->save($event);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventByEventId(string $eventId): ?VkEventDTO
    {
        return $this->repository->getEventByEventId($eventId);
    }

    /**
     * {@inheritDoc}
     */
    public function removeOldEvents(int $days, bool $processed): int
    {
        return $this->repository->removeOldEvents($days, $processed);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnprocessedWithAttempts(int $maxAttempts): array
    {
        return $this->repository->getUnprocessedWithAttempts($maxAttempts);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
