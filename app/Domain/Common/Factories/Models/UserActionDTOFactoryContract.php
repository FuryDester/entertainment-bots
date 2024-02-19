<?php

namespace App\Domain\Common\Factories\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Models\Common\UserAction;
use Illuminate\Support\Carbon;

interface UserActionDTOFactoryContract
{
    public static function createFromParams(int $userId, int $quizActionId, string|Carbon $endsAt): UserActionDTO;

    public static function createFromModel(UserAction $userAction): UserActionDTO;
}
