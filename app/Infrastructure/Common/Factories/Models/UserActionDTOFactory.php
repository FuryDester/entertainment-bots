<?php

namespace App\Infrastructure\Common\Factories\Models;

use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Models\Common\UserAction;
use Illuminate\Support\Carbon;

final class UserActionDTOFactory implements UserActionDTOFactoryContract
{
    public static function createFromParams(int $userId, int $quizActionId, Carbon|string $endsAt): UserActionDTO
    {
        return (new UserActionDTO)
            ->setUserId($userId)
            ->setQuizActionId($quizActionId)
            ->setEndsAt(is_string($endsAt) ? new Carbon($endsAt) : $endsAt);
    }

    public static function createFromModel(UserAction $userAction): UserActionDTO
    {
        return self::createFromParams(
            $userAction->user_id,
            $userAction->quiz_action_id,
            $userAction->ends_at
        );
    }
}
