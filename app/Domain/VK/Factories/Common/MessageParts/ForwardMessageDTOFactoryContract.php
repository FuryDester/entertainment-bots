<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ForwardMessageDTO;

interface ForwardMessageDTOFactoryContract
{
    /**
     * @param  object[]  $attachments
     */
    public static function createFromParams(
        int $date,
        int $fromId,
        ?int $id,
        int $peerId,
        ?string $text,
        int $conversationMessageId,
        array $attachments,
    ): ForwardMessageDTO;

    /**
     * @param array{
     *     date: int,
     *     from_id: int,
     *     id?: int,
     *     peer_id: int,
     *     text: string|null,
     *     conversation_message_id: int,
     *     attachments: array,
     * } $data
     */
    public static function createFromApiData(array $data): ForwardMessageDTO;
}
