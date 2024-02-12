<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use Carbon\Carbon;

final class QuizDTOFactory implements QuizDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): QuizDTO
    {
        return (new QuizDTO())
            ->setId($data['id'] ?? null)
            ->setTitle($data['title'])
            ->setDescription($data['description'] ?? '')
            ->setImage($data['image'])
            ->setStartsAt(($data['starts_at'] ?? null) ? (new Carbon($data['starts_at'])) : null)
            ->setEndsAt(($data['ends_at'] ?? null) ? (new Carbon($data['ends_at'])) : null)
            ->setActionId($data['action_id'] ?? null)
            ->setQuestionCooldown($data['question_cooldown'] ?? 0)
            ->setCreatedAt(($data['created_at'] ?? null) ? (new Carbon($data['created_at'])) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? (new Carbon($data['updated_at'])) : null);
    }
}
