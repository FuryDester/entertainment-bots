<?php

namespace App\Domain\Quiz\Services\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

interface QuizQuestionServiceContract
{
    /**
     * Получение количества вопросов по тесту.
     * Если передан пользователь, то возвращается количество вопросов, которые он еще не прошел.
     */
    public function getQuestionsCount(QuizDTO $quiz, UserDTO $user = null): int;

    /**
     * Получение случайного вопроса по тесту, который пользователь еще не проходил
     */
    public function getRandomQuestion(QuizDTO $quiz, UserDTO $user): ?QuizQuestionDTO;

    /**
     * Получение вопроса по идентификатору
     */
    public function getById(int $id): ?QuizQuestionDTO;
}
