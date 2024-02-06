<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\GeoDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ForwardMessageDTO;
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
     *     reply_message: ForwardMessageDTO|null,
     *     fwd_messages: ForwardMessageDTO[]|null,
     *     action: ActionDTO|null,
     *     admin_author_id: int|null,
     *     is_cropped: bool|null,
     *     members_count: int|null,
     *     was_listened: bool|null,
     *     pinned_at: int|null,
     *     message_tag: string|null,
     *     is_expired: bool|null,
     *     geo: GeoDTO|null,
     * } $data
     */
    public static function createFromData(array $data): MessageDTO;

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
     *     reply_message: array|null,
     *     fwd_messages: array|null,
     *     action: array|null,
     *     admin_author_id: int|null,
     *     is_cropped: bool|null,
     *     members_count: int|null,
     *     was_listened: bool|null,
     *     pinned_at: int|null,
     *     message_tag: string|null,
     *     is_expired: bool|null,
     *     geo: array|null,
     *  } $data
     */
    public static function createFromApiData(array $data): MessageDTO;
}
