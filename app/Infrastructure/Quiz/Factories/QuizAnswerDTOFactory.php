<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizAnswerDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use Illuminate\Support\Carbon;

final class QuizAnswerDTOFactory implements QuizAnswerDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        string $answer,
        int $questionId,
        bool $isCorrect,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizAnswerDTO {
        return (new QuizAnswerDTO())
            ->setId($id)
            ->setAnswer($answer)
            ->setQuestionId($questionId)
            ->setIsCorrect($isCorrect)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }
}
