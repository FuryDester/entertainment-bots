<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizUserStatusDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;
use Illuminate\Support\Carbon;

final class QuizUserStatusDTOFactory implements QuizUserStatusDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        int $userId,
        int $quizId,
        bool $isDone = false,
        Carbon $doneAt = null,
        Carbon $createdAt = null,
        Carbon $updatedAt = null,
    ): QuizUserStatusDTO {
        return (new QuizUserStatusDTO())
            ->setId($id)
            ->setUserId($userId)
            ->setQuizId($quizId)
            ->setIsDone($isDone)
            ->setDoneAt($doneAt)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }
}
