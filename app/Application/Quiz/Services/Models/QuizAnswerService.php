<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\QuizAnswerRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizAnswerServiceContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

final readonly class QuizAnswerService implements QuizAnswerServiceContract
{
    public function __construct(
        private QuizAnswerRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getQuizAnswersByQuestion(QuizQuestionDTO $question): array
    {
        return $this->repository->getQuizAnswersByQuestion($question);
    }

    public function getById(int $id): ?QuizAnswerDTO
    {
        return $this->repository->getById($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getByIds(array $ids): array
    {
        return $this->repository->getByIds($ids);
    }
}
