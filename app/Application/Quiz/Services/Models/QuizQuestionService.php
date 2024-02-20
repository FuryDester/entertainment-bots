<?php

namespace App\Application\Quiz\Services\Models;

use App\Domain\Quiz\Repositories\QuizQuestionRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizQuestionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use Illuminate\Support\Arr;

final readonly class QuizQuestionService implements QuizQuestionServiceContract
{
    public function __construct(
        private QuizQuestionRepositoryContract $repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getQuestionsCount(QuizDTO $quiz, ?UserDTO $user = null): int
    {
        return count($this->repository->getQuestionsByQuiz($quiz, $user));
    }

    /**
     * {@inheritDoc}
     */
    public function getRandomQuestion(QuizDTO $quiz, UserDTO $user): ?QuizQuestionDTO
    {
        $questions = $this->repository->getQuestionsByQuiz($quiz, $user);

        return empty($questions) ? null : Arr::random($questions);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): ?QuizQuestionDTO
    {
        return $this->repository->getById($id);
    }
}
