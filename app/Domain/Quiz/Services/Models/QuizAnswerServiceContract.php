<?php

namespace App\Domain\Quiz\Services\Models;

use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;

interface QuizAnswerServiceContract
{
    /**
     * Получение ответов на вопрос теста.
     * @return QuizAnswerDTO[]
     */
    public function getQuizAnswersByQuestion(QuizQuestionDTO $question): array;

    public function getById(int $id): ?QuizAnswerDTO;

    /**
     * Получение ответов по идентификаторам
     * @param int[] $ids
     * @return QuizAnswerDTO[]
     */
    public function getByIds(array $ids): array;
}
