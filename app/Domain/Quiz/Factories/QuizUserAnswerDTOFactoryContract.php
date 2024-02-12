<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use Illuminate\Support\Carbon;

interface QuizUserAnswerDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        int $questionId,
        ?int $answerId,
        ?string $answerText,
        int $userId,
        Carbon $answeredAt,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizUserAnswerDTO;
}
