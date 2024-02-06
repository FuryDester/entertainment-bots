<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\ClientInfoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;

final class ClientInfoDTOFactory implements ClientInfoDTOFactoryContract
{
    public static function createFromParams(
        array $buttonActions,
        bool $keyboard,
        bool $inlineKeyboard,
        bool $carousel,
        int $langId,
    ): ClientInfoDTO {
        return (new ClientInfoDTO())
            ->setButtonActions($buttonActions)
            ->setKeyboard($keyboard)
            ->setInlineKeyboard($inlineKeyboard)
            ->setCarousel($carousel)
            ->setLangId($langId);
    }
}
