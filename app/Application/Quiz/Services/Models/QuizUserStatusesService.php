<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\Models\QuizUserStatusesRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizUserStatusesServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;

final readonly class QuizUserStatusesService implements QuizUserStatusesServiceContract
{
    public function __construct(
        protected QuizUserStatusesRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function isQuizDone(QuizDTO $quiz, UserDTO $user): bool
    {
        $quiz = $this->repository->getUserQuizStatus($user, $quiz);

        return $quiz->isDone();
    }

    public function save(QuizUserStatusDTO $dto): bool
    {
        return $this->repository->save($dto);
    }
}
