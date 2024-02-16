<?php

namespace App\Domain\Quiz\Services;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;

interface QuizUserStatusesServiceContract
{
    /**
     * Проверка, что пользователь прошел тест.
     */
    public function isQuizDone(QuizDTO $quiz, UserDTO $user): bool;

    public function save(QuizUserStatusDTO $dto): bool;
}
