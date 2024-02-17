<?php

namespace App\Domain\Quiz\Repositories\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;

interface QuizUserAnswerRepositoryContract
{
    public function save(QuizUserAnswerDTO $answer): bool;

    /**
     * Получает ответ пользователя на вопрос, если он есть
     */
    public function getByUserAndQuestion(UserDTO $user, QuizQuestionDTO $question): ?QuizUserAnswerDTO;

    /**
     * Получение ответов пользователя на вопросы теста.
     *
     * @return QuizUserAnswerDTO[]
     */
    public function getAnswersByQuiz(UserDTO $user, QuizDTO $quiz): array;
}
