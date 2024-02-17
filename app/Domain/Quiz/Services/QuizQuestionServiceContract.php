<?php

namespace App\Domain\Quiz\Services;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

interface QuizQuestionServiceContract
{
    /**
     * Получение количества вопросов по тесту
     */
    public function getQuestionsCount(QuizDTO $quiz): int;

    /**
     * Получение случайного вопроса по тесту, который пользователь еще не проходил
     */
    public function getRandomQuestion(QuizDTO $quiz, UserDTO $user): QuizQuestionDTO;
}
