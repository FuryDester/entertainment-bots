<?php

namespace App\Infrastructure\VK\Enums;

enum ActionEnum: string
{
    case MessageNew = 'message_new';
    case WallReplyNew = 'wall_reply_new';
}
