<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;
use Illuminate\Support\Carbon;

final class QuizQuestionDTOFactory implements QuizQuestionDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        string $question,
        QuestionTypeEnum $type,
        int $points,
        int $quizId,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizQuestionDTO {
        return (new QuizQuestionDTO())
            ->setId($id)
            ->setQuestion($question)
            ->setType($type)
            ->setPoints($points)
            ->setQuizId($quizId)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }
}
