<?php

namespace App\Infrastructure\Quiz\Traits;

use App\Domain\Quiz\Services\QuizUserStatusesServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

trait QuizAvailability
{
    /**
     * Проверка доступности теста для пользователя.
     * Возвращает массив с ключами, которые означают причины недоступности теста.
     * Если оба ключа true, то тест доступен.
     *
     * @return array{
     *     by_time: bool,
     *     by_completed: bool,
     * }
     */
    private function checkQuizAvailability(QuizDTO $quiz, UserDTO $user): array
    {
        $now = now();
        $availableByTime = (! $quiz->getStartsAt() || $quiz->getStartsAt() >= $now)
            && (! $quiz->getEndsAt() || $quiz->getEndsAt() <= $now);

        /** @var QuizUserStatusesServiceContract $quizUserStatusService */
        $quizUserStatusService = app(QuizUserStatusesServiceContract::class);

        return [
            'by_time' => $availableByTime,
            'by_completed' => ! $quizUserStatusService->isQuizDone($quiz, $user),
        ];
    }
}
