<?php

namespace App\Infrastructure\VK\DataTransferObjects\Common\MessageParts;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\VK\Enums\ButtonActionEnum;

final class ClientInfoDTO extends AbstractDTO
{
    /** @var ButtonActionEnum[] */
    protected array $buttonActions;

    protected bool $keyboard;

    protected bool $inlineKeyboard;

    protected bool $carousel;

    protected int $langId;

    /**
     * @return ButtonActionEnum[]
     */
    public function getButtonActions(): array
    {
        return $this->buttonActions;
    }

    /**
     * @param ButtonActionEnum[] $buttonActions
     */
    public function setButtonActions(array $buttonActions): ClientInfoDTO
    {
        $this->buttonActions = $buttonActions;
        return $this;
    }

    public function isKeyboard(): bool
    {
        return $this->keyboard;
    }

    public function setKeyboard(bool $keyboard): ClientInfoDTO
    {
        $this->keyboard = $keyboard;
        return $this;
    }

    public function isInlineKeyboard(): bool
    {
        return $this->inlineKeyboard;
    }

    public function setInlineKeyboard(bool $inlineKeyboard): ClientInfoDTO
    {
        $this->inlineKeyboard = $inlineKeyboard;
        return $this;
    }

    public function isCarousel(): bool
    {
        return $this->carousel;
    }

    public function setCarousel(bool $carousel): ClientInfoDTO
    {
        $this->carousel = $carousel;
        return $this;
    }

    public function getLangId(): int
    {
        return $this->langId;
    }

    public function setLangId(int $langId): ClientInfoDTO
    {
        $this->langId = $langId;
        return $this;
    }
}
