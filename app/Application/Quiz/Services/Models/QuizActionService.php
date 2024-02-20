<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\QuizActionRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizActionServiceContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;

final readonly class QuizActionService implements QuizActionServiceContract
{
    public function __construct(
        private QuizActionRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getByType(ActionTypeEnum $type): array
    {
        return $this->repository->getByType($type);
    }

    public function getById(int $id): ?QuizActionDTO
    {
        return $this->repository->getById($id);
    }
}
