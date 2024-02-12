<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use Illuminate\Support\Carbon;

interface QuizAnswerDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        string $answer,
        int $questionId,
        bool $isCorrect,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizAnswerDTO;
}
