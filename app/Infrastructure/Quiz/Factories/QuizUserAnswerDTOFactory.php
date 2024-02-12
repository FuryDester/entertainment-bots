<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use Illuminate\Support\Carbon;

final class QuizUserAnswerDTOFactory implements QuizUserAnswerDTOFactoryContract
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
    ): QuizUserAnswerDTO {
        return (new QuizUserAnswerDTO())
            ->setId($id)
            ->setQuestionId($questionId)
            ->setAnswerId($answerId)
            ->setAnswerText($answerText)
            ->setUserId($userId)
            ->setAnsweredAt($answeredAt)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }
}
