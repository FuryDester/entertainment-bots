<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizUserStatusDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;
use Illuminate\Support\Carbon;

final readonly class QuizUserStatusDTOFactory implements QuizUserStatusDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        int $userId,
        int $quizId,
        bool $isDone = false,
        Carbon|string|null $doneAt = null,
        Carbon|string|null $createdAt = null,
        Carbon|string|null $updatedAt = null,
    ): QuizUserStatusDTO {
        return (new QuizUserStatusDTO)
            ->setId($id)
            ->setUserId($userId)
            ->setQuizId($quizId)
            ->setIsDone($isDone)
            ->setDoneAt($doneAt ? new Carbon($doneAt) : null)
            ->setCreatedAt($createdAt ? new Carbon($createdAt) : null)
            ->setUpdatedAt($updatedAt ? new Carbon($updatedAt) : null);
    }
}
