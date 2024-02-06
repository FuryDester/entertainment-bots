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

    /**
     * @param array{
     *     button_actions: string[],
     *     keyboard: bool,
     *     inline_keyboard: bool,
     *     carousel: bool,
     *     lang_id: int,
     * } $data
     */
    public static function createFromApiData(array $data): ClientInfoDTO;
}
