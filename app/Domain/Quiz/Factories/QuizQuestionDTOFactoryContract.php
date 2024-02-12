<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;
use Illuminate\Support\Carbon;

interface QuizQuestionDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        string $question,
        QuestionTypeEnum $type,
        int $points,
        int $quizId,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizQuestionDTO;
}
