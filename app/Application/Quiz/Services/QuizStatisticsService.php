<?php

namespace App\Application\Quiz\Services;

use App\Domain\Quiz\Repositories\Models\QuizUserAnswerRepositoryContract;
use App\Domain\Quiz\Services\Models\QuizAnswerServiceContract;
use App\Domain\Quiz\Services\QuizStatisticsServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use Illuminate\Support\Arr;

final class QuizStatisticsService implements QuizStatisticsServiceContract
{
    /**
     * {@inheritDoc}
     */
    public function getCorrectAnswersCount(UserDTO $user, QuizDTO $quiz): int
    {
        /** @var QuizUserAnswerRepositoryContract $userAnswersRepository */
        $userAnswersRepository = app(QuizUserAnswerRepositoryContract::class);
        $userAnswers = $userAnswersRepository->getAnswersByQuiz($user, $quiz);
        $answerIds = Arr::map($userAnswers, static fn (QuizUserAnswerDTO $answer) => $answer->getAnswerId());

        /** @var QuizAnswerServiceContract $answerService */
        $answerService = app(QuizAnswerServiceContract::class);
        $answers = $answerService->getByIds($answerIds);

        return count(array_filter($answers, static fn (QuizAnswerDTO $answer) => $answer->isCorrect()));
    }
}
