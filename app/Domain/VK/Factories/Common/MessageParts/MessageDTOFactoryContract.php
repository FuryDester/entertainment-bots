<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;

interface MessageDTOFactoryContract
{
    /**
     * @param array{
     *     id: int,
     *     conversation_message_id: int,
     *     out: int,
     *     peer_id: int,
     *     from_id: int,
     *     text: string|null,
     *     date: int,
     *     update_time: int|null,
     *     random_id: int,
     *     ref: string|null,
     *     ref_source: string|null,
     *     attachments: object[],
     *     important: bool,
     *     payload: string|null,
     *     reply_message: MessageDTO|null,
     *     fwd_messages: MessageDTO[]|null,
     *     action: ActionDTO|null,
     *     admin_author_id: int|null,
     *     is_cropped: bool|null,
     *     members_count: int|null,
     *     was_listened: bool|null,
     *     pinned_at: int|null,
     *     message_tag: string|null,
     *     is_expired: bool|null,
     * } $data
     */
    public static function createFromData(array $data): MessageDTO;
}
