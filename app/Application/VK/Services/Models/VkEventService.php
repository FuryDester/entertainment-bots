<?php

namespace App\Application\VK\Services\Models;

use App\Domain\VK\Repositories\VkEventRepositoryContract;
use App\Domain\VK\Services\Models\VkEventServiceContract;
use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;

final class VkEventService implements VkEventServiceContract
{
    public function __construct(protected VkEventRepositoryContract $repository) {}

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
}
