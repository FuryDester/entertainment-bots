<?php

namespace App\Domain\Quiz\Services;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

interface QuizStatisticsServiceContract
{
    /**
     * Получение количества правильных ответов пользователя на тест.
     */
    public function getCorrectAnswersCount(UserDTO $user, QuizDTO $quiz): int;
}
