<?php

namespace App\Domain\Quiz\Repositories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;

interface QuizRepositoryContract
{
    public function getQuizById(int $id): ?QuizDTO;

    /**
     * @return QuizDTO[]
     */
    public function getAvailableQuizzes(): array;
}
