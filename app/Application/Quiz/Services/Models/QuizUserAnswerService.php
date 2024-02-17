<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\Models\QuizUserAnswerRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizUserAnswerServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;

final readonly class QuizUserAnswerService implements QuizUserAnswerServiceContract
{
    public function __construct(
       protected QuizUserAnswerRepositoryContract $repository,
    ) {
    }

    public function save(QuizUserAnswerDTO $answer): bool
    {
        return $this->repository->save($answer);
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserAndQuestion(UserDTO $user, QuizQuestionDTO $question): ?QuizUserAnswerDTO
    {
        return $this->repository->getByUserAndQuestion($user, $question);
    }
}
