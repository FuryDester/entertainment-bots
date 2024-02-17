<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizAnswerDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Models\Quiz\QuizAnswer;
use Illuminate\Support\Carbon;

final readonly class QuizAnswerDTOFactory implements QuizAnswerDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        string $answer,
        int $questionId,
        bool $isCorrect,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizAnswerDTO {
        return (new QuizAnswerDTO)
            ->setId($id)
            ->setAnswer($answer)
            ->setQuestionId($questionId)
            ->setIsCorrect($isCorrect)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }

    public static function createFromModel(QuizAnswer $model): QuizAnswerDTO
    {
        return self::createFromParams(
            $model->id,
            $model->answer,
            $model->question_id,
            $model->is_correct,
            $model->created_at ? new Carbon($model->created_at) : null,
            $model->updated_at ? new Carbon($model->updated_at) : null,
        );
    }
}
