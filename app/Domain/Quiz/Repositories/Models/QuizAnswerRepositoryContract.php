<?php

namespace App\Domain\Quiz\Repositories\Models;

use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

interface QuizAnswerRepositoryContract
{
    /**
     * Получение ответов на вопрос теста.
     *
     * @return QuizAnswerDTO[]
     */
    public function getQuizAnswersByQuestion(QuizQuestionDTO $question): array;

    public function getById(int $id): ?QuizAnswerDTO;

    /**
     * @param  int[]  $ids
     * @return QuizAnswerDTO[]
     */
    public function getByIds(array $ids): array;
}
