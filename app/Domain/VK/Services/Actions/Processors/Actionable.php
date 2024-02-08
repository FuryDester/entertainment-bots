<?php

namespace App\Domain\VK\Services\Actions\Processors;

use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;

interface Actionable
{
    public static function getActionName(): ActionEnum;

    public static function perform(CallbackRequestDTO $data): bool;
}
