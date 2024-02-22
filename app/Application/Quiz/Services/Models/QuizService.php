<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

final readonly class QuizService implements QuizServiceContract
{
    public function __construct(
        protected readonly QuizRepositoryContract $repository,
    ) {
    }

    public function getQuizById(int $id): ?QuizDTO
    {
        return $this->repository->getQuizById($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableQuizzes(?UserDTO $user = null): array
    {
        return $this->repository->getAvailableQuizzes($user);
    }
}
