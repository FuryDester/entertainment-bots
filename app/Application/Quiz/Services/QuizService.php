<?php


use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Domain\Quiz\Services\QuizServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
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
    public function getAvailableQuizzes(?UserDTO $user = null): array
    {
        return $this->repository->getAvailableQuizzes($user);
    }
}
