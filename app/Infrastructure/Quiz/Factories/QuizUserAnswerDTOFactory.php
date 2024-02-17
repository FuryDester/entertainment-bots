<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use App\Models\Quiz\QuizUserAnswer;
use Illuminate\Support\Carbon;

final readonly class QuizUserAnswerDTOFactory implements QuizUserAnswerDTOFactoryContract
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
        return (new QuizUserAnswerDTO)
            ->setId($id)
            ->setQuestionId($questionId)
            ->setAnswerId($answerId)
            ->setAnswerText($answerText)
            ->setUserId($userId)
            ->setAnsweredAt($answeredAt)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }

    public static function createFromModel(QuizUserAnswer $model): QuizUserAnswerDTO
    {
        return self::createFromParams(
            $model->id,
            $model->question_id,
            $model->answer_id,
            $model->answer_text,
            $model->user_id,
            new Carbon($model->answered_at),
            $model->created_at ? new Carbon($model->created_at) : null,
            $model->updated_at ? new Carbon($model->updated_at) : null,
        );
    }
}
