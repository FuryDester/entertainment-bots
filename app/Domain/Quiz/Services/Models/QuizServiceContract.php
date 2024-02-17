<?php

namespace App\Domain\Quiz\Services\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

interface QuizServiceContract
{
    public function getQuizById(int $id): ?QuizDTO;

    /**
     * @return QuizDTO[]
     */
    public function getAvailableQuizzes(?UserDTO $user = null): array;
}
