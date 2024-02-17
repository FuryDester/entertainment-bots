<?php

namespace App\Domain\Quiz\Repositories\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

interface QuizQuestionRepositoryContract
{
    /**
     * Получение вопросов по тесту.
     * Если передан пользователь, то возвращаются только те вопросы, на которые пользователь еще не ответил.
     *
     * @return QuizQuestionDTO[]
     */
    public function getQuestionsByQuiz(QuizDTO $quiz, ?UserDTO $user = null): array;

    /**
     * Получение вопроса по идентификатору
     */
    public function getById(int $id): ?QuizQuestionDTO;
}
