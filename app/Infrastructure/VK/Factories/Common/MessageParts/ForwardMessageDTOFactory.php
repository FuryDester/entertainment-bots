<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\ForwardMessageDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ForwardMessageDTO;
use Illuminate\Support\Arr;

final readonly class ForwardMessageDTOFactory implements ForwardMessageDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromParams(
        int $date,
        int $fromId,
        int $id,
        int $peerId,
        ?string $text,
        int $conversationMessageId,
        array $attachments,
    ): ForwardMessageDTO {
        return (new ForwardMessageDTO)
            ->setDate($date)
            ->setFromId($fromId)
            ->setId($id)
            ->setPeerId($peerId)
            ->setText($text)
            ->setConversationMessageId($conversationMessageId)
            ->setAttachments($attachments);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): ForwardMessageDTO
    {
        return self::createFromParams(
            $data['date'],
            $data['from_id'],
            $data['id'],
            $data['peer_id'],
            $data['text'] ?? null,
            $data['conversation_message_id'],
            Arr::map($data['attachments'], static fn ($attachment) => (object) $attachment),
        );
    }
}
