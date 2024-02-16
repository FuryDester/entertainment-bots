<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;
use Illuminate\Support\Carbon;

interface QuizUserStatusDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        int $userId,
        int $quizId,
        bool $isDone = false,
        Carbon $doneAt = null,
        Carbon $createdAt = null,
        Carbon $updatedAt = null,
    ): QuizUserStatusDTO;
}
