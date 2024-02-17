<?php

namespace App\Domain\Quiz\Services\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;

interface QuizUserAnswerServiceContract
{
    public function save(QuizUserAnswerDTO $answer): bool;

    /**
     * Получение ответа пользователя на вопрос, если он есть.
     */
    public function getByUserAndQuestion(UserDTO $user, QuizQuestionDTO $question): ?QuizUserAnswerDTO;
}
