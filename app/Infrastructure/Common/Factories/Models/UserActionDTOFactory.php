<?php

namespace App\Infrastructure\Common\Factories\Models;

use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Models\Common\UserAction;
use Illuminate\Support\Carbon;

final class UserActionDTOFactory implements UserActionDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        int $userId,
        int $quizActionId,
        Carbon|string|null $endsAt,
    ): UserActionDTO {
        return (new UserActionDTO)
            ->setId($id)
            ->setUserId($userId)
            ->setQuizActionId($quizActionId)
            ->setEndsAt($endsAt ? new Carbon($endsAt) : null);
    }

    public static function createFromModel(UserAction $userAction): UserActionDTO
    {
        return self::createFromParams(
            $userAction->id,
            $userAction->user_id,
            $userAction->quiz_action_id,
            $userAction->ends_at
        );
    }
}
