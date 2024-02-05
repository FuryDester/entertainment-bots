<?php

namespace App\Infrastructure\VK\Enums;

enum MessageEventTypeEnum: string
{
    case ChatPhotoUpdate = 'chat_photo_update';
    case ChatPhotoRemove = 'chat_photo_remove';
    case ChatCreate = 'chat_create';
    case ChatTitleUpdate = 'chat_title_update';
    case ChatInviteUser = 'chat_invite_user';
    case ChatKickUser = 'chat_kick_user';
    case ChatPinMessage = 'chat_pin_message';
    case ChatUnpinMessage = 'chat_unpin_message';
    case ChatInviteUserByLink = 'chat_invite_user_by_link';
}
