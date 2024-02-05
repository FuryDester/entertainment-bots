<?php

namespace App\Application\VK\Services\Actions;

use App\Domain\VK\Services\Actions\Actionable;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;

final class MessageNewAction implements Actionable
{
    public static function getActionName(): ActionEnum
    {
        return ActionEnum::MessageNew;
    }

    public static function perform(CallbackRequestDTO $data): void
    {

    }
}
