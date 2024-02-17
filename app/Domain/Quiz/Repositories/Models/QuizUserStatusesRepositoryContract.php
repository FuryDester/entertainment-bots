<?php

namespace App\Domain\Quiz\Repositories\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;

interface QuizUserStatusesRepositoryContract
{
    /**
     * Сохранение или обновление статуса пользователя по тесту
     */
    public function save(QuizUserStatusDTO $quizUserStatus): bool;

    /**
     * Получение статуса пользователя по тесту.
     * Если статуса нет, то возвращается новый объект с предустановленными значениями.
     */
    public function getUserQuizStatus(UserDTO $user, QuizDTO $quiz): QuizUserStatusDTO;
}
