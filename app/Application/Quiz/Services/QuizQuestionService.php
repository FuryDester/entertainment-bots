<?php

namespace App\Application\Quiz\Services;

use App\Domain\Quiz\Repositories\QuizQuestionRepositoryContract;
use App\Domain\Quiz\Services\QuizQuestionServiceContract;
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
    public function getQuestionsCount(QuizDTO $quiz): int
    {
        return count($this->repository->getQuestionsByQuiz($quiz));
    }

    /**
     * {@inheritDoc}
     */
    public function getRandomQuestion(QuizDTO $quiz, UserDTO $user): QuizQuestionDTO
    {
        return Arr::random($this->repository->getQuestionsByQuiz($quiz, $user));
    }
}
