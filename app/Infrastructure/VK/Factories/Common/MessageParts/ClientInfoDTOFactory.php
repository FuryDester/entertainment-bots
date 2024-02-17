<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\ClientInfoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ClientInfoDTO;
use App\Infrastructure\VK\Enums\ButtonActionEnum;
use Illuminate\Support\Arr;

final readonly class ClientInfoDTOFactory implements ClientInfoDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromParams(
        array $buttonActions,
        bool $keyboard,
        bool $inlineKeyboard,
        bool $carousel,
        int $langId,
    ): ClientInfoDTO {
        return (new ClientInfoDTO)
            ->setButtonActions($buttonActions)
            ->setKeyboard($keyboard)
            ->setInlineKeyboard($inlineKeyboard)
            ->setCarousel($carousel)
            ->setLangId($langId);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): ClientInfoDTO
    {
        return (new ClientInfoDTO)
            ->setButtonActions(Arr::map($data['button_actions'], static fn ($item) => ButtonActionEnum::tryFrom($item)))
            ->setKeyboard($data['keyboard'])
            ->setInlineKeyboard($data['inline_keyboard'])
            ->setCarousel($data['carousel'])
            ->setLangId($data['lang_id']);
    }
}
