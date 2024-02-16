<?php

namespace App\Infrastructure\Common\Logger;

use Monolog\Handler\TelegramBotHandler;

final class StatedTelegramBotHandler extends TelegramBotHandler
{
    public static function __set_state(array $data)
    {
        return new self(
            $data['apiKey'],
            $data['channel'],
            $data['level'],
            $data['bubble'],
            $data['parseMode'],
            $data['disableWebPagePreview'],
            $data['disableNotification'],
            $data['splitLongMessages'],
            $data['delayBetweenMessages'],
            $data['topic'],
        );
    }
}
