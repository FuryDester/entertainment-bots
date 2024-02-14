<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

final class QuizService implements QuizServiceContract
{
    public function __construct(
        protected QuizRepositoryContract $repository,
    ) {}

    public function getQuizById(int $id): ?QuizDTO
    {
        return $this->repository->getQuizById($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableQuizzes(): array
    {
        return $this->repository->getAvailableQuizzes();
    }
}
