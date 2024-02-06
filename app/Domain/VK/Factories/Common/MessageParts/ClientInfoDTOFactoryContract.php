<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\Enums\ButtonActionEnum;

interface ClientInfoDTOFactoryContract
{
    /**
     * @param ButtonActionEnum[] $buttonActions
     */
    public static function createFromParams(
        array $buttonActions,
        bool $keyboard,
        bool $inlineKeyboard,
        bool $carousel,
        int $langId,
    ): ClientInfoDTO;
}
