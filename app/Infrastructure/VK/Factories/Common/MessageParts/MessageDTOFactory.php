<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\GeoDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ForwardMessageDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\MessageDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use Illuminate\Support\Arr;

final class MessageDTOFactory implements MessageDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): MessageDTO
    {
        return (new MessageDTO())
            ->setId($data['id'])
            ->setConversationMessageId($data['conversation_message_id'])
            ->setOut($data['out'])
            ->setPeerId($data['peer_id'])
            ->setFromId($data['from_id'])
            ->setText($data['text'] ?? null)
            ->setDate($data['date'])
            ->setUpdateTime($data['update_time'] ?? null)
            ->setRandomId($data['random_id'])
            ->setRef($data['ref'] ?? null)
            ->setRefSource($data['ref_source'] ?? null)
            ->setAttachments($data['attachments'])
            ->setImportant($data['important'])
            ->setPayload($data['payload'] ?? null)
            ->setReplyMessage($data['reply_message'] ?? null)
            ->setFwdMessages($data['fwd_messages'] ?? null)
            ->setAction($data['action'] ?? null)
            ->setAdminAuthorId($data['admin_author_id'] ?? null)
            ->setIsCropped($data['is_cropped'] ?? null)
            ->setMembersCount($data['members_count'] ?? null)
            ->setWasListened($data['was_listened'] ?? null)
            ->setPinnedAt($data['pinned_at'] ?? null)
            ->setMessageTag($data['message_tag'] ?? null)
            ->setIsExpired($data['is_expired'] ?? null)
            ->setGeo($data['geo'] ?? null);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): MessageDTO
    {
        /** @var ForwardMessageDTOFactoryContract $forwardMessageFactory */
        $forwardMessageFactory = app(ForwardMessageDTOFactoryContract::class);
        /** @var ActionDTOFactoryContract $actionFactory */
        $actionFactory = app(ActionDTOFactoryContract::class);
        /** @var GeoDTOFactoryContract $geoFactory */
        $geoFactory = app(GeoDTOFactoryContract::class);

        return (new MessageDTO())
            ->setConversationMessageId($data['conversation_message_id'])
            ->setId($data['id'])
            ->setOut($data['out'])
            ->setPeerId($data['peer_id'])
            ->setFromId($data['from_id'])
            ->setText($data['text'] ?? null)
            ->setDate($data['date'])
            ->setUpdateTime($data['update_time'] ?? null)
            ->setRandomId($data['random_id'])
            ->setRef($data['ref'] ?? null)
            ->setRefSource($data['ref_source'] ?? null)
            ->setAttachments(Arr::map($data['attachments'], fn(array $attachment) => (object) $attachment))
            ->setImportant($data['important'])
            ->setPayload($data['payload'] ?? null)
            ->setReplyMessage(($data['reply_message'] ?? null) ? $forwardMessageFactory::createFromApiData($data['reply_message']) : null)
            ->setFwdMessages(Arr::map($data['fwd_messages'] ?? [], fn(array $fwdMessage) => $forwardMessageFactory::createFromApiData($fwdMessage)))
            ->setAction(($data['action'] ?? null) ? $actionFactory::createFromApiData($data['action']) : null)
            ->setAdminAuthorId($data['admin_author_id'] ?? null)
            ->setIsCropped($data['is_cropped'] ?? null)
            ->setMembersCount($data['members_count'] ?? null)
            ->setWasListened($data['was_listened'] ?? null)
            ->setPinnedAt($data['pinned_at'] ?? null)
            ->setMessageTag($data['message_tag'] ?? null)
            ->setIsExpired($data['is_expired'] ?? null)
            ->setGeo(($data['geo'] ?? null) ? $geoFactory::createFromApiData($data['geo']) : null);
    }
}
