<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Support\Carbon;

final readonly class QuizQuestionDTOFactory implements QuizQuestionDTOFactoryContract
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
        return (new QuizQuestionDTO)
            ->setId($id)
            ->setQuestion($question)
            ->setType($type)
            ->setPoints($points)
            ->setQuizId($quizId)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }

    public static function createFromModel(QuizQuestion $model): QuizQuestionDTO
    {
        return (new QuizQuestionDTO)
            ->setId($model->id ?? null)
            ->setQuestion($model->question)
            ->setType(QuestionTypeEnum::from($model->type))
            ->setPoints($model->points)
            ->setQuizId($model->quiz_id)
            ->setCreatedAt($model->created_at ? new Carbon($model->created_at) : null)
            ->setUpdatedAt($model->updated_at ? new Carbon($model->updated_at) : null);
    }
}
