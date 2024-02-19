<?php

namespace App\Infrastructure\Quiz\Traits;

use App\Domain\Common\Services\Models\UserServiceContract;
use App\Domain\Quiz\Services\Models\QuizQuestionServiceContract;
use App\Domain\Quiz\Services\Models\QuizUserStatusesServiceContract;
use App\Domain\Quiz\Services\QuizStatisticsServiceContract;
use App\Events\Quiz\QuizCompleted;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Support\Facades\Log;

trait QuizEnd
{
    use SendMessage;

    /**
     * Обработка завершения теста пользователем.
     */
    private function quizEnd(UserDTO $user, QuizDTO $quiz): void
    {
        Log::info('Quiz finished', [
            'quiz_id' => $quiz->getId(),
            'user' => $user->toArray(),
        ]);

        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);

        $user->setState(ActionStageEnum::Index);
        $user->setData(null);
        $userService->save($user);

        /** @var QuizStatisticsServiceContract $quizStatisticsService */
        $quizStatisticsService = app(QuizStatisticsServiceContract::class);
        $correctAnswers = $quizStatisticsService->getCorrectAnswersCount($user, $quiz);

        /** @var QuizQuestionServiceContract $questionService */
        $questionService = app(QuizQuestionServiceContract::class);
        $questionCount = $questionService->getQuestionsCount($quiz);

        /** @var QuizUserStatusesServiceContract $userStatusService */
        $userStatusService = app(QuizUserStatusesServiceContract::class);
        $status = $userStatusService->getByUserAndQuiz($user, $quiz);
        $status->setIsDone(true)->setDoneAt(now());
        $userStatusService->save($status);

        $this->sendMessage(
            $user->getVkPeerId(),
            sprintf(
                'Тест завершён! Правильных ответов: %d из %d (%d%%)',
                $correctAnswers,
                $questionCount,
                (int) ($correctAnswers * 100 / $questionCount)
            )
        );

        QuizCompleted::dispatch($quiz, $user);
    }
}
