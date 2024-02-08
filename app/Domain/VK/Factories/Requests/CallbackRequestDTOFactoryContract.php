<?php

namespace App\Domain\VK\Factories\Requests;

use App\Infrastructure\VK\DataTransferObjects\Models\VkEventDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;

interface CallbackRequestDTOFactoryContract
{
    public static function createFromRequest(array $data): CallbackRequestDTO;

    public static function createFromVkEvent(VkEventDTO $dto): CallbackRequestDTO;
}
